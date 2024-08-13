<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jenis Surat</title>
</head>
<body>
    <h2>Tambah Jenis Surat Baru</h2>
    <form action="" method="POST">
        <label for="nama_surat">Nama Surat:</label>
        <input type="text" id="nama_surat" name="nama_surat" required><br>

        <label for="template_file">Nama File Template:</label>
        <input type="text" id="template_file" name="template_file" required><br>

        <label for="required_fields">Field yang Dibutuhkan (Dipisah dengan Koma):</label>
        <input type="text" id="required_fields" name="required_fields" required><br>

        <button type="submit">Tambah</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once 'config/connection.php';

        $nama_surat = $_POST['nama_surat'];
        $template_file = $_POST['template_file'];
        $required_fields = $_POST['required_fields'];

        $sql = "INSERT INTO jenis_surat (nama_surat, template_file, required_fields) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $nama_surat, $template_file, $required_fields);

        if ($stmt->execute()) {
            echo "Jenis surat berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
