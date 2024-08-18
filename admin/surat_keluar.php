<?php
session_start();
require_once '../config/connection.php';

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil data surat keluar dari database
$query = "SELECT * FROM surat_keluar";
$result = mysqli_query($conn, $query);

// Proses penambahan surat keluar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
    $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
    $penerima = mysqli_real_escape_string($conn, $_POST['penerima']);
    $tanggal_surat = mysqli_real_escape_string($conn, $_POST['tanggal_surat']);
    $tanggal_kirim = mysqli_real_escape_string($conn, $_POST['tanggal_kirim']);
    $ringkasan = mysqli_real_escape_string($conn, $_POST['ringkasan']);

    // Proses upload lampiran
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $lampiran = $_FILES['lampiran']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($lampiran);

        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $target_file)) {
            // Insert data ke database
            $insert_query = "INSERT INTO surat_keluar (nomor_surat, perihal, penerima, tanggal_surat, tanggal_kirim, lampiran, ringkasan) 
                             VALUES ('$nomor_surat', '$perihal', '$penerima', '$tanggal_surat', '$tanggal_kirim', '$lampiran', '$ringkasan')";

            if (mysqli_query($conn, $insert_query)) {
                header('Location: surat_keluar.php');
                exit();
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keluar</title>
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
                <h3>Tambah Surat Keluar</h3>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" id="perihal" name="perihal" required>
                    </div>
                    <div class="form-group">
                        <label for="penerima">Penerima</label>
                        <input type="text" id="penerima" name="penerima" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_kirim">Tanggal Kirim</label>
                        <input type="date" id="tanggal_kirim" name="tanggal_kirim" required>
                    </div>
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan</label>
                        <textarea id="ringkasan" name="ringkasan" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran Surat (PDF)</label>
                        <input type="file" id="lampiran" name="lampiran" accept="application/pdf" required>
                    </div>
                    <button type="submit">Tambah Surat</button>
                </form>
            </div>

            <div class="card table-container">
                <h3>List Surat Keluar</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Penerima</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Kirim</th>
                            <th>Ringkasan</th>
                            <th>Lampiran</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td><?php echo $row['nomor_surat']; ?></td>
                                <td><?php echo $row['perihal']; ?></td>
                                <td><?php echo $row['penerima']; ?></td>
                                <td><?php echo $row['tanggal_surat']; ?></td>
                                <td><?php echo $row['tanggal_kirim']; ?></td>
                                <td><?php echo $row['ringkasan']; ?></td>
                                <td><a href="../uploads/<?php echo $row['lampiran']; ?>" target="_blank">Lihat Lampiran</a></td>
                                <td class="actions">
                                    <a href="edit_surat.php?id=<?php echo $row['id']; ?>&jenis=keluar"><i class="fa-solid fa-edit"></i></a>
                                    <a href="delete_surat.php?id=<?php echo $row['id']; ?>&jenis=keluar&redirect=surat_keluar.php" onclick="return confirm('Anda yakin ingin menghapus surat ini?')"><i class="fa-solid fa-trash"></i></a>
                                    <a href="detail_surat.php?id=<?php echo $row['id']; ?>&jenis=keluar"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
