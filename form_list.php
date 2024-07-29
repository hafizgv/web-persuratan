<?php
require 'config/connection.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari tabel `surat`
$sql = "SELECT id, nama, nik, jenis_kelamin, tanggal_lahir, warganegara, pekerjaan, status_pernikahan, alamat FROM surat";
$result = $conn->query($sql);

// Hitung jumlah data
$num_rows = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            font-size: 16px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Data Surat</h1>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Jenis Kelamin</th>
                    <th>Tanggal Lahir</th>
                    <th>Warganegara</th>
                    <th>Pekerjaan</th>
                    <th>Status Pernikahan</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($num_rows > 0) {
                    $no = 1;
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nik'] . "</td>";
                        echo "<td>" . $row['jenis_kelamin'] . "</td>";
                        echo "<td>" . $row['tanggal_lahir'] . "</td>";
                        echo "<td>" . $row['warganegara'] . "</td>";
                        echo "<td>" . $row['pekerjaan'] . "</td>";
                        echo "<td>" . $row['status_pernikahan'] . "</td>";
                        echo "<td>" . $row['alamat'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <p>Total data: <?php echo $num_rows; ?></p>
        <a href="index.php" class="btn">Kembali ke Halaman Utama</a>
    </div>
</body>
</html>

<?php
$conn->close();
?>
