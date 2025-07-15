<?php
session_start();
include '../config/db.php';

// 1. Autentikasi: Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
  header("Location: ../admin/login");
  exit;
}

// 2. Validasi Input: Cek apakah ID ada dan merupakan angka.
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = "Permintaan tidak valid. ID surat tidak ditemukan.";
    header("Location: ../admin/lihat_surat");
    exit;
}
$id = $_GET['id'];

// 3. Hapus Record Database: Gunakan prepared statement untuk mencegah SQL injection.
$stmt = $conn->prepare("DELETE FROM surat WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['msg'] = "Data surat berhasil dihapus.";
} else {
    $_SESSION['error'] = "Gagal menghapus data surat: " . $conn->error;
}

$stmt->close();
$conn->close();

// 4. Redirect kembali ke halaman daftar surat.
header("Location: ../admin/lihat_surat");
exit;