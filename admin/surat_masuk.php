<?php
session_start();
require_once '../config/connection.php';

// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}

// Ambil data surat masuk dari database
$query = "SELECT * FROM surat_masuk";
$result = mysqli_query($conn, $query);

// Proses penambahan surat masuk
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomor_surat']);
    $perihal = mysqli_real_escape_string($conn, $_POST['perihal']);
    $pengirim = mysqli_real_escape_string($conn, $_POST['pengirim']);
    $tanggal_surat = mysqli_real_escape_string($conn, $_POST['tanggal_surat']);
    $tanggal_terima = mysqli_real_escape_string($conn, $_POST['tanggal_terima']);
    $ringkasan = mysqli_real_escape_string($conn, $_POST['ringkasan']);

    // Proses upload lampiran
    if (isset($_FILES['lampiran']) && $_FILES['lampiran']['error'] == 0) {
        $lampiran = $_FILES['lampiran']['name'];
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($lampiran);

        if (move_uploaded_file($_FILES['lampiran']['tmp_name'], $target_file)) {
            // Insert data ke database
            $insert_query = "INSERT INTO surat_masuk (nomor_surat, perihal, pengirim, tanggal_surat, tanggal_terima, lampiran, ringkasan) 
                             VALUES ('$nomor_surat', '$perihal', '$pengirim', '$tanggal_surat', '$tanggal_terima', '$lampiran', '$ringkasan')";

            if (mysqli_query($conn, $insert_query)) {
                header('Location: surat_masuk.php');
                exit();
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
    <title>Surat Masuk</title>
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
        .table-container form {
            margin-bottom: 20px;
        }
        .table-container form select {
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
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
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            padding: 8px 12px;
            background-color: #f0f0f0;
            color: #333;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination a:hover {
            background-color: #e0e0e0;
        }

        .pagination a.active {
            background-color: #333;
            color: #fff;
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
                <h3>Tambah Surat Masuk</h3>
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
                        <label for="pengirim">Pengirim</label>
                        <input type="text" id="pengirim" name="pengirim" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_surat">Tanggal Surat</label>
                        <input type="date" id="tanggal_surat" name="tanggal_surat" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_terima">Tanggal Terima</label>
                        <input type="date" id="tanggal_terima" name="tanggal_terima" required>
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

            <?php
            // Tentukan jumlah surat per halaman
            $limit = 5;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $limit;

            // Ambil data filter dari URL jika ada
            $selected_bulan = isset($_GET['bulan']) ? $_GET['bulan'] : '';
            $selected_tahun = isset($_GET['tahun']) ? $_GET['tahun'] : '';

            $where_clause = "";
            if (!empty($selected_bulan) && !empty($selected_tahun)) {
                $where_clause = "WHERE MONTH(tanggal_surat) = '$selected_bulan' AND YEAR(tanggal_surat) = '$selected_tahun'";
            }

            // Hitung total surat
            $total_query = "SELECT COUNT(*) as total FROM surat_masuk $where_clause"; 
            $total_result = $conn->query($total_query);
            $total_row = $total_result->fetch_assoc();
            $total_records = $total_row['total'];
            $total_pages = ceil($total_records / $limit);

            // Ambil data surat berdasarkan filter dan halaman
            $query = "SELECT * FROM surat_masuk $where_clause LIMIT $limit OFFSET $offset";
            $result = $conn->query($query);
            ?>

            <div class="card table-container">
                <h3>List Surat Masuk</h3>
                <form method="GET" action="surat_masuk.php" class="filter-form">
                    <label for="bulan">Bulan:</label>
                    <select name="bulan" id="bulan">
                        <option value="">-- Pilih Bulan --</option>
                        <?php
                        $bulan = [
                            "01" => "Januari",
                            "02" => "Februari",
                            "03" => "Maret",
                            "04" => "April",
                            "05" => "Mei",
                            "06" => "Juni",
                            "07" => "Juli",
                            "08" => "Agustus",
                            "09" => "September",
                            "10" => "Oktober",
                            "11" => "November",
                            "12" => "Desember"
                        ];

                        foreach ($bulan as $key => $value) {
                            echo "<option value=\"$key\">$value</option>";
                        }
                        ?>
                    </select>

                    <label for="tahun">Tahun:</label>
                    <select name="tahun" id="tahun">
                        <option value="">-- Pilih Tahun --</option>
                        <?php
                        $current_year = date("Y");
                        for ($year = $current_year; $year >= 2000; $year--) {
                            echo "<option value=\"$year\">$year</option>";
                        }
                        ?>
                    </select>

                    <button type="submit">Filter</button>
                </form>

                <table>
                    <thead>
                        <tr>
                            <th>Nomor Surat</th>
                            <th>Perihal</th>
                            <th>Pengirim</th>
                            <th>Tanggal Surat</th>
                            <th>Tanggal Terima</th>
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
                                <td><?php echo $row['pengirim']; ?></td>
                                <td><?php echo $row['tanggal_surat']; ?></td>
                                <td><?php echo $row['tanggal_terima']; ?></td>
                                <td><?php echo $row['ringkasan']; ?></td>
                                <td><a href="../uploads/<?php echo $row['lampiran']; ?>" target="_blank">Lihat Lampiran</a></td>
                                <td class="actions">
                                    <a href="edit_surat.php?id=<?php echo $row['id']; ?>&jenis=masuk"><i class="fa-solid fa-edit"></i></a>
                                    <a href="delete_surat.php?id=<?php echo $row['id']; ?>&jenis=masuk&redirect=surat_masuk.php" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');"><i class="fa-solid fa-trash"></i></a>
                                    <a href="detail_surat.php?id=<?php echo $row['id']; ?>&jenis=masuk"><i class="fa-solid fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php
                    $base_url = "?bulan=$selected_bulan&tahun=$selected_tahun";
                    if ($page > 1): ?>
                        <a href="<?= $base_url ?>&page=1">&laquo;</a>
                        <a href="<?= $base_url ?>&page=<?= $page - 1; ?>">&lt;</a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="<?= $base_url ?>&page=<?= $i; ?>" <?= ($i == $page) ? 'class="active"' : ''; ?>><?= $i; ?></a>
                    <?php endfor; ?>

                    <?php if ($page < $total_pages): ?>
                        <a href="<?= $base_url ?>&page=<?= $page + 1; ?>">&gt;</a>
                        <a href="<?= $base_url ?>&page=<?= $total_pages; ?>">&raquo;</a>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
