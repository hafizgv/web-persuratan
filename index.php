<?php
require_once 'config/connection.php';

// Ambil data jenis surat dari database
$sql = "SELECT id, nama_surat FROM jenis_surat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembuatan Surat Otomatis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #e0f2f1;
            color: #004d40;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .login-admin {
            margin-right: 20px;
        }

        .login-admin a {
            color: #004d40;
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid #004d40;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .login-admin a:hover {
            background-color: #b2dfdb;
            color: #004d40;
        }

        main {
            padding: 20px;
            text-align: center;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .container a {
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 15px 20px;
            margin: 10px;
            border-radius: 5px;
            flex: 1 1 calc(33.333% - 40px); /* Adjust the width based on container space */
            box-sizing: border-box;
            text-align: center;
            transition: background-color 0.3s, color 0.3s;
        }

        .container a:hover {
            background-color: #0056b3;
        }

        .back-home {
            margin-top: 20px;
            text-align: center;
        }

        footer {
            background-color: #e0f2f1;
            color: #004d40;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Sistem Persuratan Online</h1>
        <div class="login-admin">
            <a href="auth/login.php">Login</a>
        </div>
    </header>

    <main>
        <h2>Pilih Jenis Surat yang Ingin Anda Buat:</h2>
        <div class="container">
            <?php while($row = $result->fetch_assoc()): ?>
                <a href="guest/buat_surat.php?type=<?= $row['id'] ?>"><?= htmlspecialchars($row['nama_surat']) ?></a>
            <?php endwhile; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Sistem Persuratan Online</p>
    </footer>
</body>
</html>

<?php
$conn->close();
?>
