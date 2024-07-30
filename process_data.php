<?php
include 'config/connection.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan data dari formulir
$nama = $_POST['nama'];
$nik = $_POST['nik'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$tanggal_lahir = $_POST['tanggal_lahir'];
$warganegara = $_POST['warganegara'];
$pekerjaan = $_POST['pekerjaan'];
$status_pernikahan = $_POST['status_pernikahan'];
$alamat = $_POST['alamat'];

// Menyimpan data ke tabel `surat`
$sql = "INSERT INTO surat (nama, nik, jenis_kelamin, tanggal_lahir, warganegara, pekerjaan, status_pernikahan, alamat)
VALUES ('$nama', '$nik', '$jenis_kelamin', '$tanggal_lahir', '$warganegara', '$pekerjaan', '$status_pernikahan', '$alamat')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: form_list.php");
exit();
?>

?>