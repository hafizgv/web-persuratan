<?php
session_start();

// Cek apakah admin sudah login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

require_once '../config/connection.php'; // File konfigurasi untuk koneksi database

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;

if (!$id) {
    echo "ID surat tidak ditemukan.";
    exit;
}

// Ambil data surat berdasarkan ID
$sql = "SELECT * FROM surat WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Surat tidak ditemukan.";
    exit;
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
        }

        .logout-btn {
            margin-right: 20px;
        }

        .logout-btn a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border: 2px solid white;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-btn a:hover {
            background-color: white;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 30px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #218838;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            word-wrap: break-word; /* Memastikan teks panjang dibungkus ke baris baru */
        }

        table th {
            background-color: #f8f8f8;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        table td.ringkasan {
            max-width: 200px; /* Atur sesuai kebutuhan */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-top: 40px;
        }

        label i {
            margin-right: 8px; /* Jarak antara ikon dan teks label */
        }

        h2 i {
            margin-right: 8px; /* Jarak antara ikon dan teks h2 */
        }

        .aksi {
            display: flex;
            gap: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Detail Surat</h1>
        <div class="logout-btn">
            <a href="logout.php">Logout</a>
        </div>
    </header>

    <div class="container">
        <h2><i class="fas fa-eye"></i> Detail Surat</h2>
        <table>
            <tr>
                <th>Nomor Surat</th>
                <td><?php echo htmlspecialchars($row['nomor_surat']); ?></td>
            </tr>
            <tr>
                <th>Perihal</th>
                <td><?php echo htmlspecialchars($row['perihal']); ?></td>
            </tr>
            <tr>
                <th>Pengirim</th>
                <td><?php echo htmlspecialchars($row['pengirim']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Surat</th>
                <td><?php echo htmlspecialchars($row['tanggal_surat']); ?></td>
            </tr>
            <tr>
                <th>Tanggal Terima/Kirim</th>
                <td><?php echo htmlspecialchars($row['tanggal_terima']); ?></td>
            </tr>
            <tr>
                <th>Ringkasan Isi Surat</th>
                <td><?php echo nl2br(htmlspecialchars($row['ringkasan_surat'])); ?></td>
            </tr>
            <tr>
                <th>Lampiran</th>
                <td><a href="<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">Lihat Lampiran</a></td>
            </tr>
        </table>
        <a href="dashboard.php" class="button"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <footer>
        <p>&copy; 2024 Dashboard Admin. All rights reserved.</p>
    </footer>
</body>
</html>
