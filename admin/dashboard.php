<?php
// Connect to the database
include '../config/connection.php';

// Fetch counts from the database
$suratMasukQuery = "SELECT COUNT(*) AS count FROM surat_masuk";
$suratKeluarQuery = "SELECT COUNT(*) AS count FROM surat_keluar";
$suratKeteranganQuery = "SELECT COUNT(*) AS count FROM surat_keterangan";

$suratMasukResult = mysqli_query($conn, $suratMasukQuery);
$suratKeluarResult = mysqli_query($conn, $suratKeluarQuery);
$suratKeteranganResult = mysqli_query($conn, $suratKeteranganQuery);

if ($suratMasukResult && $suratKeluarResult && $suratKeteranganResult) {
    $suratMasukCount = mysqli_fetch_assoc($suratMasukResult)['count'];
    $suratKeluarCount = mysqli_fetch_assoc($suratKeluarResult)['count'];
    $suratKeteranganCount = mysqli_fetch_assoc($suratKeteranganResult)['count'];
} else {
    $suratMasukCount = 0;
    $suratKeluarCount = 0;
    $suratKeteranganCount = 0;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f6; /* Warna latar belakang konten */
            display: flex;
            height: 100vh; /* Full height for body */
            overflow: hidden; /* Prevent scrollbars */
        }
        .container {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            background-color: #e0f2f1; /* Warna pastel untuk sidebar */
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            height: 100vh; /* Full height sidebar */
            position: fixed; /* Fixed position to stay in place */
            top: 0;
            left: 0;
            overflow-y: auto; /* Scroll if needed */
        }
        .sidebar h2 {
            color: #004d40; /* Warna teks sidebar */
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
            background-color: #b2dfdb; /* Warna pastel saat hover */
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Margin to align with sidebar */
            display: flex;
            flex-wrap: wrap;
            justify-content: center; /* Center cards */
        }
        .card {
            background-color: #ffffff; /* Warna latar belakang kartu */
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 10px;
            width: 250px; /* Lebar card */
            height: 150px; /* Tinggi card */
            text-align: center;
        }
        .card h3 {
            margin: 0;
            font-size: 22px;
        }
        .card p {
            font-size: 18px;
            color: #555;
        }
        .card i {
            font-size: 36px;
            color: #004d40;
            display: block;
            margin-bottom: 10px;
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
            <a href="tambah_akun.php"><i class="fa-solid fa-user-plus"></i> Tambah Akun</a>
            <a href="lihat_akun.php"><i class="fa-solid fa-users"></i> Lihat Akun</a>
            <a href="../auth/logout.php"><i class="fa-solid fa-sign-out-alt"></i> Logout</a>
        </div>
        <div class="content">
            <div class="card">
                <i class="fa-solid fa-inbox"></i>
                <h3>Jumlah Surat Masuk</h3>
                <p><?php echo $suratMasukCount; ?></p>
            </div>
            <div class="card">
                <i class="fa-solid fa-envelope"></i>
                <h3>Jumlah Surat Keluar</h3>
                <p><?php echo $suratKeluarCount; ?></p>
            </div>
            <div class="card">
                <i class="fa-solid fa-file-alt"></i>
                <h3>Jumlah Surat Keterangan</h3>
                <p><?php echo $suratKeteranganCount; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
