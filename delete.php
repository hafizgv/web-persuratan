<?php
require 'config/connection.php';

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data dari tabel `surat` berdasarkan ID
    $sql = "DELETE FROM surat WHERE id = $id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "ID not set!";
}

$conn->close();
header('Location: form_list.php');
?>
