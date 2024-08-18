<?php
// Include connection file
include '../config/connection.php';

// Check if ID, jenis, and redirect are set
if (isset($_GET['id']) && isset($_GET['jenis']) && isset($_GET['redirect'])) {
    $id = intval($_GET['id']);
    $jenis = $_GET['jenis'];
    $redirect = $_GET['redirect'];

    // Determine the table based on jenis
    switch ($jenis) {
        case 'masuk':
            $table = 'surat_masuk';
            break;
        case 'keluar':
            $table = 'surat_keluar';
            break;
        case 'keterangan':
            $table = 'surat_keterangan';
            break;
        default:
            die('Jenis tidak valid.');
    }

    // Prepare SQL statement
    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ?");
    $stmt->bind_param('i', $id);

    // Execute and check success
    if ($stmt->execute()) {
        // Redirect to the appropriate page
        header("Location: $redirect");
        exit();
    } else {
        echo "Gagal menghapus surat: " . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "ID, jenis, atau redirect tidak ditentukan.";
}
?>
