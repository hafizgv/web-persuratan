<?php
session_start();
require_once '../config/connection.php';

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil data jenis surat dari database
$sql = "SELECT id, nama_surat FROM jenis_surat";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan</title>
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
        .card form .form-group {
            margin-bottom: 15px;
        }
        .card form .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .card form .form-group input,
        .card form .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
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
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .card-container a {
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

        .card-container a:hover {
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
                <h3>Pilih Jenis Surat yang Ingin Anda Buat:</h3>
                <div class="card-container">
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <a href="admin_buat_surat.php?type=<?= $row['id'] ?>"><?= htmlspecialchars($row['nama_surat']) ?></a>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- Bagian List Surat -->
            <div class="card table-container">
                <h3>List Surat Keterangan</h3>
                <?php
                $query = "SELECT sk.id, js.nama_surat, sk.file_lampiran FROM surat_keterangan sk JOIN jenis_surat js ON sk.jenis_surat_id = js.id";
                $result = $conn->query($query);
                ?>

                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Surat</th>
                            <th>Lampiran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama_surat']); ?></td>
                                    <td><a href="<?= htmlspecialchars($row['file_lampiran']); ?>" target="_blank">Lihat Lampiran</a></td>
                                    <td><a href="delete_surat.php?id=<?php echo $row['id']; ?>&jenis=keterangan&redirect=surat_keterangan.php" onclick="return confirm('Anda yakin ingin menghapus surat ini?')"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Belum ada surat yang dibuat.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
