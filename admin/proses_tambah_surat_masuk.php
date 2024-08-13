<?php
session_start(); // Pertahankan jika memang dibutuhkan
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_surat = $_POST['nomor_surat'];
    $perihal = $_POST['perihal'];
    $pengirim = $_POST['pengirim'];
    $tanggal_surat = $_POST['tanggal_surat'];
    $tanggal_terima = $_POST['tanggal_terima'];
    $ringkasan_surat = $_POST['ringkasan_surat'];
    $status = 'masuk';

    // Proses upload file PDF
    $target_dir = "../uploads/";
    $file_path = basename($_FILES["lampiran_surat"]["name"]);
    $target_file = $target_dir . $file_path;
    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Validasi tipe file
    if ($file_type != "pdf") {
        echo "Hanya file PDF yang diperbolehkan.";
        exit;
    }

    // Pindahkan file ke folder uploads
    if (move_uploaded_file($_FILES["lampiran_surat"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO surat (nomor_surat, perihal, pengirim, tanggal_surat, tanggal_terima, file_path, ringkasan_surat, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing the statement: " . $conn->error);
        }        
        $stmt->bind_param("ssssssss", $nomor_surat, $perihal, $pengirim, $tanggal_surat, $tanggal_terima, $file_path, $ringkasan_surat, $status);

        if ($stmt->execute()) {
            header("Location: dashboard.php");
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat mengupload file.";
    }
}

$conn->close();
?>
