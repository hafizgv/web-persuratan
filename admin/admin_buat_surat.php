<?php
require_once '../vendor/autoload.php'; 
require_once '../config/connection.php'; 

// Periksa apakah jenis surat sudah dipilih
if (!isset($_GET['type'])) {
    die("Jenis surat tidak dipilih.");
}

$jenis_surat_id = $_GET['type'];

// Ambil data jenis surat dari database menggunakan id
$query = "SELECT * FROM jenis_surat WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    die("Error preparing statement: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "i", $jenis_surat_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$surat = mysqli_fetch_assoc($result);

if (!$surat) {
    die("Jenis surat tidak ditemukan.");
}

$template_file = '../templates/' . $surat['template_file'];
$required_fields = explode(',', $surat['required_fields']);
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $formData = [];
    foreach ($required_fields as $field) {
        $formData[$field] = $_POST[$field] ?? '';
    }

    $data = $formData;

    ob_start();
    include $template_file; 
    $html = ob_get_clean();

    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($html);

    $filename = $surat['nama_surat'] . "_" . time() . ".pdf";
    $file_path = '../uploads/' . $filename;
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

    $surat_keterangan_id = mysqli_insert_id($conn);

    // Simpan data surat ke tabel surat_keterangan_data
    foreach ($formData as $field_name => $field_value) {
        $data_query = "INSERT INTO surat_keterangan_data (surat_keterangan_id, jenis_surat_id, field_name, field_value) VALUES (?, ?, ?, ?)";
        $data_stmt = mysqli_prepare($conn, $data_query);

        if (!$data_stmt) {
            die("Error preparing data insert statement: " . mysqli_error($conn));
        }

        mysqli_stmt_bind_param($data_stmt, "iiss", $surat_keterangan_id, $jenis_surat_id, $field_name, $field_value);
        if (!mysqli_stmt_execute($data_stmt)) {
            die("Error executing data insert statement: " . mysqli_stmt_error($data_stmt));
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            display: flex;
            height: 100vh;
            overflow: auto;
        }
        .header {
            background-color: #e0f2f1;
            color: #004d40;
            padding: 1.5rem;
            text-align: center;
            font-size: 24px;
            position: fixed;
            width: calc(100% - 250px); /* Mengurangi lebar sidebar */
            top: 0;
            left: 250px; /* Agar header dimulai dari ujung kanan sidebar */
            z-index: 500;
            border-bottom: 2px solid #ccc;
        }
        .container {
            display: flex;
            width: 100%;
            margin-top: 60px;
        }
        .sidebar {
            width: 250px;
            background-color: #e0f2f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 0;
            bottom: 0;
            overflow-y: auto;
            z-index: 1000;
            border-right: 2px solid #ccc;
        }
        .sidebar h2 {
            color: #004d40;
            font-size: 24px;
            margin: 0 0 1.9rem 1rem;
        }
        .sidebar a {
            display: block;
            color: #004d40;
            text-decoration: none;
            padding: 10px;
            font-size: 18px;
            margin: 10px 0;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .sidebar a:hover {
            background-color: #b2dfdb;
        }
        .content {
            margin-left: 295px;
            padding: 20px;
            width: calc(100% - 270px);
            overflow-y: auto;
            height: 100vh;
            box-sizing: border-box;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .card h3 {
            margin: 0 0 20px 0;
            font-size: 20px;
        }
        .card form .form-group {
            margin-bottom: 15px;
        }
        .card form .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .card form input,
        .card form textarea,
        .card form select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            resize: vertical;
        }
        .card form .form-group input[type="file"] {
            padding: 3px;
        }
        .card form button {
            padding: 10px 15px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .card form button:hover {
            background-color: #45a049;
        }
        .table-container {
            margin-top: 20px;
        }
        .table-container table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-container table th,
        .table-container table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .table-container table th {
            background-color: #f7f7f7;
        }
        .table-container table tr:hover {
            background-color: #f1f1f1;
        }
        .actions a {
            color: #333;
            margin-right: 10px;
            font-size: 18px;
        }
        .actions a:hover {
            color: #007bff;
        }
        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h3 {
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
    <div class="header">
        <b>Sistem Persuratan Online</b>
    </div>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Home</a>
            <a href="surat_masuk.php"><i class="fa-solid fa-inbox"></i> Surat Masuk</a>
            <a href="surat_keluar.php"><i class="fa-solid fa-envelope"></i> Surat Keluar</a>
            <a href="surat_keterangan.php"><i class="fa-solid fa-file-alt"></i> Surat Keterangan</a>
            <a href="tambah_akun.php"><i class="fa-solid fa-user-plus"></i> Tambah Akun</a>
            <a href="lihat_akun.php"><i class="fa-solid fa-users"></i> Lihat Akun</a>
            <a href="../auth/logout.php"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <div class="card">
                <h3>Buat Surat - <?php echo htmlspecialchars($surat['nama_surat']); ?></h3>

                <?php if ($success): ?>
                    <div class="success">
                        <p>Surat berhasil dibuat!</p>
                    </div>
                <?php else: ?>
                    <form method="POST">
                        <?php foreach ($required_fields as $field): ?>
                            <?php 
                                // Pisahkan kata berdasarkan underscore
                                $words = explode('_', $field);
                                
                                // Jika kata pertama adalah 'nik', ubah menjadi 'NIK'
                                if (strtolower($words[0]) === 'nik') {
                                    $words[0] = strtoupper($words[0]);
                                } else {
                                    // Jika bukan 'nik', kapitalisasi huruf pertama kata pertama
                                    $words[0] = ucwords($words[0]);
                                }
                                
                                // Kapitalisasi huruf pertama kata selanjutnya
                                for ($i = 1; $i < count($words); $i++) {
                                    $words[$i] = ucwords($words[$i]);
                                }

                                // Gabungkan kata-kata kembali menjadi label
                                $label = implode(' ', $words);
                                $input_type = 'text';
                                $attributes = '';
                                $placeholder = ''; // Placeholder default kosong

                                if (strpos($field, 'tanggal') !== false) {
                                    $input_type = 'date';
                                } elseif (strpos($field, 'nik') !== false) {
                                    $attributes = 'maxlength="16" pattern="\d{16}"';
                                } elseif (strpos($field, 'jenis_kelamin') !== false) {
                                    echo "<label for='{$field}'>{$label}:</label>";
                                    echo "<select id='{$field}' name='{$field}' required>
                                            <option value='Laki-laki'>Laki-laki</option>
                                            <option value='Perempuan'>Perempuan</option>
                                        </select>";
                                    continue;
                                } elseif (strpos($field, 'dalam_angka') !== false) {
                                    $placeholder = '30'; // Placeholder untuk 'dalam_angka'
                                } elseif (strpos($field, 'dalam_kata') !== false) {
                                    $placeholder = 'Tiga Puluh'; // Placeholder untuk 'dalam_kata'
                                }

                                echo "<label for='{$field}'>{$label}:</label>";
                                echo "<input type='{$input_type}' id='{$field}' name='{$field}' placeholder='{$placeholder}' {$attributes} required>";
                            ?>
                        <?php endforeach; ?>
                        <button type="submit">Buat Surat</button>
                    </form>
                <?php endif; ?>

                <div class="back-home">
                    <a href="surat_keterangan.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
