<?php
require_once __DIR__ . '/vendor/autoload.php'; 
require_once 'config/connection.php'; 

// Periksa apakah jenis surat sudah dipilih
if (!isset($_GET['type'])) {
    die("Jenis surat tidak dipilih.");
}

$jenis_surat_id = $_GET['type'];

// Ambil data jenis surat dari database menggunakan id
$query = "SELECT * FROM jenis_surat WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $jenis_surat_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$surat = mysqli_fetch_assoc($result);

if (!$surat) {
    die("Jenis surat tidak ditemukan.");
}

$template_file = '/templates' . $surat['template_file'];
$required_fields = explode(',', $surat['required_fields']);
$success = false;

// Tangani form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formData = [];
    foreach ($required_fields as $field) {
        $formData[$field] = $_POST[$field] ?? '';
    }

    // Pastikan data dioper ke template
    $data = $formData;

    ob_start();
    include $template_file; // Di dalam file ini Anda menggunakan $data
    $html = ob_get_clean();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    $filename = $surat['nama_surat'] . "_" . time() . ".pdf";
    $file_path = '/uploads' . $filename;
    $mpdf->Output($file_path, \Mpdf\Output\Destination::FILE);

    // Simpan informasi file ke database
    $insert_query = "INSERT INTO surat_keterangan (jenis_surat_id, nama_surat, file_lampiran, created_at) VALUES (?, ?, ?, NOW())";
    $stmt = mysqli_prepare($conn, $insert_query);

    if (!$stmt) {
        die("Error preparing insert statement: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "iss", $jenis_surat_id, $surat['nama_surat'], $file_path);
    if (!mysqli_stmt_execute($stmt)) {
        die("Error executing insert statement: " . mysqli_stmt_error($stmt));
    }
    $success = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Surat - <?php echo htmlspecialchars($surat['nama_surat']); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        .success {
            text-align: center;
            margin-top: 20px;
        }

        .back-home {
            margin-top: 20px;
            text-align: center;
        }

        .back-home a {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-home a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Buat Surat - <?php echo htmlspecialchars($surat['nama_surat']); ?></h2>

    <?php if ($success): ?>
        <div class="success">
            <p>Surat berhasil dibuat!</p>
        </div>
    <?php else: ?>
        <form method="POST">
            <?php foreach ($required_fields as $field): ?>
                <label for="<?php echo $field; ?>"><?php echo ucwords(str_replace('_', ' ', $field)); ?>:</label>
                <input type="text" id="<?php echo $field; ?>" name="<?php echo $field; ?>" required>
            <?php endforeach; ?>
            <button type="submit">Buat Surat</button>
        </form>
    <?php endif; ?>

    <div class="back-home">
        <a href="index.php">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>
