<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}

include '../config/db.php';

// 1. Validasi input: Pastikan ID ada dan merupakan angka
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Jika ID tidak ada atau tidak valid, alihkan ke halaman daftar surat
    header("Location: lihat_surat");
    exit;
}
$id = $_GET['id'];

// 2. Gunakan Prepared Statement untuk keamanan (mencegah SQL Injection)
$stmt = $conn->prepare("SELECT * FROM surat WHERE id = ?");
$stmt->bind_param("i", $id); // 'i' berarti tipe data integer
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Jika data dengan ID tersebut tidak ditemukan
    echo "Data surat tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $data['jenis_surat']; ?> - Desa Sumberjati</title>
  <style>
    body { font-family: 'Times New Roman', Times, serif; width: 21cm; margin: auto; padding: 2cm; box-sizing: border-box; }
    /* Sembunyikan tombol saat mencetak */
    @media print { .action-buttons { display: none; } }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
  <h2 align="center">PEMERINTAH DESA SUMBERJATI</h2>
  <h3 align="center"><?= strtoupper($data['jenis_surat']); ?></h3>
  <hr><br>

  <p>Yang bertanda tangan di bawah ini Kepala Desa Sumberjati, menerangkan bahwa:</p>
  <table>
    <tr><td>Nama</td><td>: <?= $data['nama']; ?></td></tr>
    <tr><td>NIK</td><td>: <?= $data['nik']; ?></td></tr>
    <tr><td>Keperluan</td><td>: <?= $data['keperluan']; ?></td></tr>
  </table>

  <p>Demikian surat ini dibuat untuk dipergunakan sebagaimana mestinya.</p>
  <br><br>
  <div align="right">
    <p>Desa Maju Bersama, <?= date('d-m-Y', strtotime($data['tanggal_dibuat'])); ?></p>
    <p><strong>Kepala Desa</strong></p><br><br>
    <p><u>Robert Doe</u></p>
  </div>

  <div class="action-buttons mt-10 text-left print:hidden">
    <a href="javascript:window.print()" class="inline-block px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">🖨️ Cetak Surat</a>
    <a href="lihat_surat" class="inline-block px-4 py-2 text-sm font-medium text-white bg-gray-500 rounded hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ml-2">&larr; Kembali ke Arsip Surat</a>
  </div>
</body>
</html>
