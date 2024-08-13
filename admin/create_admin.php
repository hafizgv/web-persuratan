<?php
require_once '../config/connection.php'; // File konfigurasi untuk koneksi database

// Data akun admin yang akan dibuat
$username = 'admin'; // Ganti dengan username yang diinginkan
$password_plain = 'admin'; // Ganti dengan password yang diinginkan

// Hash password sebelum disimpan di database
$hashed_password = password_hash($password_plain, PASSWORD_DEFAULT);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Simpan username dan hash password ke database
$sql = "INSERT INTO admins (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $username, $hashed_password);

if ($stmt->execute()) {
    echo "Akun admin berhasil dibuat!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
