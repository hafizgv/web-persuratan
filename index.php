<?php
    include 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Surat</title>
</head>
<body>
    <h2>Form Input Surat</h2>
    <form action="convert.php" method="POST">
        <label for="nama">Nama:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>
        
        <label for="nik">NIK:</label><br>
        <input type="text" id="nik" name="nik" required><br><br>
        
        <label for="jenis_kelamin">Jenis Kelamin:</label><br>
        <select id="jenis_kelamin" name="jenis_kelamin" required>
            <option value="Laki-laki">Laki-laki</option>
            <option value="Perempuan">Perempuan</option>
        </select><br><br>
        
        <label for="tanggal_lahir">Tanggal Lahir:</label><br>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" required><br><br>
        
        <label for="warganegara">Warganegara / Agama:</label><br>
        <input type="text" id="warganegara" name="warganegara" required><br><br>
        
        <label for="pekerjaan">Pekerjaan:</label><br>
        <input type="text" id="pekerjaan" name="pekerjaan" required><br><br>
        
        <label for="status_pernikahan">Status Pernikahan:</label><br>
        <input type="text" id="status_pernikahan" name="status_pernikahan" required><br><br>
        
        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat" required></textarea><br><br>
        
        <input type="submit" value="Submit">
    </form>
</body>
</html>
