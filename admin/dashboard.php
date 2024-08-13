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

// Fungsi untuk mengunggah file PDF
function uploadFile($file) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file["name"]);
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi file PDF
    if($file_type != "pdf") {
        return false;
    }

    // Pindahkan file ke folder tujuan
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}

// Tambah surat masuk
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_surat_masuk'])) {
    $nomor_surat = $_POST['nomor_surat'];
    $perihal = $_POST['perihal'];
    $pengirim = $_POST['pengirim'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_terima = $_POST['tanggal_terima'];
    $ringkasan_surat = $_POST['ringkasan_surat'];
    $lampiran_surat = uploadFile($_FILES['lampiran_surat']);
    $status = 'masuk';

    if ($lampiran_surat) {
        $sql = "INSERT INTO surat (nomor_surat, perihal, pengirim, tanggal_surat, tanggal_terima, ringkasan_surat, file_path, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nomor_surat, $perihal, $pengirim, $tanggal_surat, $tanggal_terima, $ringkasan_surat, $lampiran_surat, $status);

        if ($stmt->execute()) {
            echo "Surat masuk berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gagal mengunggah lampiran surat.";
    }
}

// Tambah surat keluar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_surat_keluar'])) {
    $nomor_surat = $_POST['nomor_surat_keluar'];
    $perihal = $_POST['perihal_keluar'];
    $pengirim = $_POST['pengirim_keluar'];
    $tanggal_surat = $_POST['tanggal_surat_keluar'];
    $tanggal_terima = $_POST['tanggal_kirim'];
    $ringkasan_surat = $_POST['ringkasan_surat_keluar'];
    $lampiran_surat = uploadFile($_FILES['lampiran_surat_keluar']);
    $status = 'keluar';

    if ($lampiran_surat) {
        $sql = "INSERT INTO surat (nomor_surat, perihal, pengirim, tanggal_surat, tanggal_terima, ringkasan_surat, file_path, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssss", $nomor_surat, $perihal, $pengirim, $tanggal_surat, $tanggal_terima, $ringkasan_surat, $lampiran_surat, $status);

        if ($stmt->execute()) {
            echo "Surat keluar berhasil ditambahkan!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Gagal mengunggah lampiran surat.";
    }
}

// Ambil data surat masuk
$sql_masuk = "SELECT * FROM surat WHERE status = 'masuk' ORDER BY created_at DESC";
$result_masuk = $conn->query($sql_masuk);

// Ambil data surat keluar
$sql_keluar = "SELECT * FROM surat WHERE status = 'keluar' ORDER BY created_at DESC";
$result_keluar = $conn->query($sql_keluar);

// Fungsi untuk menghapus surat
if (isset($_GET['hapus']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql_hapus = "DELETE FROM surat WHERE id = ?";
    $stmt_hapus = $conn->prepare($sql_hapus);
    $stmt_hapus->bind_param("i", $id);
    if ($stmt_hapus->execute()) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error: " . $stmt_hapus->error;
    }
    $stmt_hapus->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
        <h1>Dashboard Admin</h1>
        <div class="logout-btn">
            <a href="logout.php">Logout</a>
        </div>
    </header>
    
    <div class="container">
        <h2><i class="fas fa-inbox"></i> Tambah Surat Masuk</h2>
        <form action="proses_tambah_surat_masuk.php" method="POST" enctype="multipart/form-data">
            <label for="nomor_surat"><i class="fas fa-envelope"></i> Nomor Surat</label>
            <input type="text" id="nomor_surat" name="nomor_surat" required>

            <label for="perihal"><i class="fas fa-tag"></i> Perihal</label>
            <input type="text" id="perihal" name="perihal" required>

            <label for="pengirim"><i class="fas fa-user"></i> Pengirim</label>
            <input type="text" id="pengirim" name="pengirim" required>

            <label for="tanggal_surat"><i class="fas fa-calendar-alt"></i> Tanggal Surat</label>
            <input type="date" id="tanggal_surat" name="tanggal_surat" required>

            <label for="tanggal_terima"><i class="fas fa-calendar-alt"></i> Tanggal Terima</label>
            <input type="date" id="tanggal_terima" name="tanggal_terima" required>

            <label for="lampiran_surat"><i class="fas fa-file-pdf"></i> Lampiran Surat (PDF)</label>
            <input type="file" id="lampiran_surat" name="lampiran_surat" accept=".pdf" required>

            <label for="ringkasan_surat"><i class="fas fa-align-left"></i> Ringkasan Isi Surat</label>
            <textarea id="ringkasan_surat" name="ringkasan_surat" required></textarea>

            <button type="submit" name="add_surat_masuk"><i class="fas fa-save"></i> Tambah Surat Masuk</button>
        </form>
    </div>

    <div class="container">
        <h2><i class="fas fa-outbox"></i> Tambah Surat Keluar</h2>
        <form action="proses_tambah_surat_keluar.php" method="POST" enctype="multipart/form-data">
            <label for="nomor_surat_keluar"><i class="fas fa-envelope"></i> Nomor Surat</label>
            <input type="text" id="nomor_surat_keluar" name="nomor_surat_keluar" required>

            <label for="perihal_keluar"><i class="fas fa-tag"></i> Perihal</label>
            <input type="text" id="perihal_keluar" name="perihal_keluar" required>

            <label for="pengirim_keluar"><i class="fas fa-user"></i> Pengirim</label>
            <input type="text" id="pengirim_keluar" name="pengirim_keluar" required>

            <label for="tanggal_surat_keluar"><i class="fas fa-calendar-alt"></i> Tanggal Surat</label>
            <input type="date" id="tanggal_surat_keluar" name="tanggal_surat_keluar" required>

            <label for="tanggal_kirim"><i class="fas fa-calendar-alt"></i> Tanggal Kirim</label>
            <input type="date" id="tanggal_kirim" name="tanggal_kirim" required>

            <label for="lampiran_surat_keluar"><i class="fas fa-file-pdf"></i> Lampiran Surat (PDF)</label>
            <input type="file" id="lampiran_surat_keluar" name="lampiran_surat_keluar" accept=".pdf" required>

            <label for="ringkasan_surat_keluar"><i class="fas fa-align-left"></i> Ringkasan Isi Surat</label>
            <textarea id="ringkasan_surat_keluar" name="ringkasan_surat_keluar" required></textarea>

            <button type="submit" name="add_surat_keluar"><i class="fas fa-save"></i> Tambah Surat Keluar</button>
        </form>
    </div>

    <div class="container">
        <h2><i class="fas fa-list"></i> Daftar Surat Masuk</h2>
        <table>
            <tr>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Terima</th>
                <th>Lampiran</th>
                <th>Ringkasan</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result_masuk->num_rows > 0): ?>
                <?php while($row = $result_masuk->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nomor_surat']; ?></td>
                        <td><?php echo $row['perihal']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['tanggal_surat']; ?></td>
                        <td><?php echo $row['tanggal_terima']; ?></td>
                        <td><a href="../uploads/<?php echo htmlspecialchars($row['file_path']); ?>" target="_blank">Lihat Lampiran</a></td>
                        <td class="ringkasan"><?php echo $row['ringkasan_surat']; ?></td>
                        <td class="aksi">
                            <a href="edit_surat.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a href="dashboard.php?hapus=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                            <a href="detail_surat.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye"></i> Detail</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Belum ada surat masuk.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <div class="container">
        <h2><i class="fas fa-list"></i> Daftar Surat Keluar</h2>
        <table>
            <tr>
                <th>Nomor Surat</th>
                <th>Perihal</th>
                <th>Pengirim</th>
                <th>Tanggal Surat</th>
                <th>Tanggal Kirim</th>
                <th>Lampiran</th>
                <th>Ringkasan</th>
                <th>Aksi</th>
            </tr>
            <?php if ($result_keluar->num_rows > 0): ?>
                <?php while($row = $result_keluar->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['nomor_surat']; ?></td>
                        <td><?php echo $row['perihal']; ?></td>
                        <td><?php echo $row['pengirim']; ?></td>
                        <td><?php echo $row['tanggal_surat']; ?></td>
                        <td><?php echo $row['tanggal_terima']; ?></td>
                        <td><a href="<?php echo $row['file_path']; ?>" target="_blank">Lihat Lampiran</a></td>
                        <td class="ringkasan"><?php echo $row['ringkasan_surat']; ?></td>
                        <td class="aksi">
                            <a href="edit_surat.php?id=<?php echo $row['id']; ?>"><i class="fas fa-edit"></i> Edit</a>
                            <a href="dashboard.php?hapus=true&id=<?php echo $row['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');"><i class="fas fa-trash-alt"></i> Hapus</a>
                            <a href="detail_surat.php?id=<?php echo $row['id']; ?>"><i class="fas fa-eye"></i> Detail</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Belum ada surat keluar.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

    <footer>
        <p>&copy; 2024 Dashboard Admin. All rights reserved.</p>
    </footer>
</body>
</html>
