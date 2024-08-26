<?php
session_start();
require_once '../config/connection.php';

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil ID surat dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$jenis_surat = isset($_GET['jenis']) ? $_GET['jenis'] : '';

if ($jenis_surat === 'masuk') {
    $query = "SELECT * FROM surat_masuk WHERE id = $id";
} else {
    $query = "SELECT * FROM surat_keluar WHERE id = $id";
}

$result = mysqli_query($conn, $query);
$surat = mysqli_fetch_assoc($result);

if (!$surat) {
    echo "Surat tidak ditemukan.";
    exit();
}

// Proses update surat
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
    $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
    $penerima_pengirim = mysqli_real_escape_string($conn, $_POST['penerima_pengirim']);
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $tanggal_surat = mysqli_real_escape_string($conn, $_POST['tanggal_surat']);
    $ringkasan = mysqli_real_escape_string($conn, $_POST['ringkasan']);

    if ($jenis_surat === 'masuk') {
        $update_query = "UPDATE surat_masuk SET nomor_surat='$nomor_surat', perihal='$perihal', pengirim='$penerima_pengirim', tanggal_surat='$tanggal_surat', ringkasan='$ringkasan' WHERE id=$id";
    } else {
        $update_query = "UPDATE surat_keluar SET nomor_surat='$nomor_surat', perihal='$perihal', penerima='$penerima_pengirim', tanggal_kirim='$tanggal', tanggal_surat='$tanggal_surat', ringkasan='$ringkasan' WHERE id=$id";
    }

    if (mysqli_query($conn, $update_query)) {
        header("Location: detail_surat.php?id=$id&jenis=$jenis_surat");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Surat</title>
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
            margin-top: 20px;
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
                <h3>Edit Surat <?php echo ucfirst($jenis_surat); ?></h3>
                <form method="POST">
                    <div class="form-group">
                        <label for="nomor_surat">Nomor Surat</label>
                        <input type="text" id="nomor_surat" name="nomor_surat" value="<?php echo $surat['nomor_surat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="perihal">Perihal</label>
                        <input type="text" id="perihal" name="perihal" value="<?php echo $surat['perihal']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="penerima_pengirim"><?php echo $jenis_surat === 'masuk' ? 'Pengirim' : 'Penerima'; ?></label>
                        <input type="text" id="penerima_pengirim" name="penerima_pengirim" value="<?php echo $jenis_surat === 'masuk' ? $surat['pengirim'] : $surat['penerima']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal"><?php echo $jenis_surat === 'masuk' ? 'Tanggal Terima' : 'Tanggal Kirim'; ?></label>
                        <input type="date" id="tanggal" name="tanggal" value="<?php echo $jenis_surat === 'masuk' ? $surat['tanggal_surat'] : $surat['tanggal_kirim']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" value="<?php echo $surat['tanggal_surat']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="ringkasan">Ringkasan</label>
                        <textarea id="ringkasan" name="ringkasan" rows="3" required><?php echo $surat['ringkasan']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="lampiran">Lampiran Surat (PDF)</label>
                        <input type="file" id="lampiran" name="lampiran" accept=".pdf">
                    </div>
                    <button type="submit">Update Surat</button>
                    <a href="<?php echo $jenis_surat == 'masuk' ? 'surat_masuk.php' : 'surat_keluar.php'; ?>" class="btn-back">Kembali ke <?php echo $jenis_surat == 'masuk' ? 'Surat Masuk' : 'Surat Keluar'; ?></a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
