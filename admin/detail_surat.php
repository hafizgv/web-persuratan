<?php
session_start();
require_once '../config/connection.php';

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil ID surat dan jenis surat dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$jenis_surat = isset($_GET['jenis']) ? $_GET['jenis'] : '';

// Tentukan query berdasarkan jenis surat
if ($jenis_surat === 'masuk') {
    $query = "SELECT * FROM surat_masuk WHERE id = $id";
} elseif ($jenis_surat === 'keluar') {
    $query = "SELECT * FROM surat_keluar WHERE id = $id";
} else {
    echo "Jenis surat tidak valid!";
    exit();
}

$result = mysqli_query($conn, $query);
$surat = mysqli_fetch_assoc($result);

if (!$surat) {
    echo "Surat tidak ditemukan!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Surat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Gunakan style yang sama seperti pada dashboard */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .container {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            background-color: #e0f2f1;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }
        .sidebar h2 {
            color: #004d40;
            font-size: 24px;
            margin: 0;
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
        .card table {
            width: 100%;
            border-collapse: collapse;
        }
        .card table th,
        .card table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .card table th {
            background-color: #f7f7f7;
        }
        .card table tr:hover {
            background-color: #f1f1f1;
        }
        .btn-back {
            font-size: 13px;
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Admin Panel</h2>
            <a href="dashboard.php"><i class="fa-solid fa-tachometer-alt"></i> Home</a>
            <a href="surat_masuk.php"><i class="fa-solid fa-inbox"></i> Surat Masuk</a>
            <a href="surat_keluar.php"><i class="fa-solid fa-envelope"></i> Surat Keluar</a>
            <a href="surat_keterangan.php"><i class="fa-solid fa-file-alt"></i> Surat Keterangan</a>
            <a href="../auth/logout.php"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <div class="card">
                <h3>Detail Surat <?php echo ucfirst($jenis_surat); ?></h3>
                <table>
                    <tr>
                        <th>Nomor Surat</th>
                        <td><?php echo htmlspecialchars($surat['nomor_surat']); ?></td>
                    </tr>
                    <tr>
                        <th>Perihal</th>
                        <td><?php echo htmlspecialchars($surat['perihal']); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo ($jenis_surat === 'masuk') ? 'Pengirim' : 'Penerima'; ?></th>
                        <td><?php echo htmlspecialchars($surat[($jenis_surat === 'masuk') ? 'pengirim' : 'penerima']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal Surat</th>
                        <td><?php echo htmlspecialchars($surat['tanggal_surat']); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo ($jenis_surat === 'masuk') ? 'Tanggal Terima' : 'Tanggal Kirim'; ?></th>
                        <td><?php echo htmlspecialchars($surat[($jenis_surat === 'masuk') ? 'tanggal_terima' : 'tanggal_kirim']); ?></td>
                    </tr>
                    <tr>
                        <th>Ringkasan</th>
                        <td><?php echo htmlspecialchars($surat['ringkasan']); ?></td>
                    </tr>
                    <tr>
                        <th>Lampiran</th>
                        <td>
                            <?php if ($surat['lampiran']) : ?>
                                <a href="../uploads/<?php echo htmlspecialchars($surat['lampiran']); ?>" target="_blank">Lihat Lampiran</a>
                            <?php else: ?>
                                Tidak ada lampiran
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
                <a href="<?php echo $jenis_surat == 'masuk' ? 'surat_masuk.php' : 'surat_keluar.php'; ?>" class="btn-back">Kembali ke <?php echo $jenis_surat == 'masuk' ? 'Surat Masuk' : 'Surat Keluar'; ?></a>
            </div>
        </div>
    </div>
</body>
</html>
