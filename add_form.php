<?php
    include 'config/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Surat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label, input, select, textarea {
            margin-bottom: 10px;
        }
        input[type="text"], input[type="date"], select, textarea {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }
        textarea {
            height: 100px;
        }
        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0056b3;
        }
        h2 {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Form Input Surat</h2>
        <form action="convert.php" method="POST">
            <label for="nama">Nama:</label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="nik">NIK:</label>
            <input type="text" id="nik" name="nik" required>
            
            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select id="jenis_kelamin" name="jenis_kelamin" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            
            <label for="tanggal_lahir">Tanggal Lahir:</label>
            <input type="date" id="tanggal_lahir" name="tanggal_lahir" required>
            
            <label for="warganegara">Warganegara / Agama:</label>
            <input type="text" id="warganegara" name="warganegara" required>
            
            <label for="pekerjaan">Pekerjaan:</label>
            <input type="text" id="pekerjaan" name="pekerjaan" required>
            
            <label for="status_pernikahan">Status Pernikahan:</label>
            <input type="text" id="status_pernikahan" name="status_pernikahan" required>
            
            <label for="alamat">Alamat:</label>
            <textarea id="alamat" name="alamat" required></textarea>
            
            <input type="submit" value="Submit">
        </form>
        <a href="index.php" class="btn">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>
