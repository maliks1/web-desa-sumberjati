<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}
include '../config/db.php';
$surat = $conn->query("SELECT * FROM surat ORDER BY tanggal_dibuat DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Data Surat - Desa Maju Bersama</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-10">

  <div class="max-w-5xl mx-auto bg-white p-6 shadow-md rounded-lg">
  <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900">📋 Arsip Surat Warga</h2>
        <a href="dashboard" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>
    <table class="w-full table-auto border">
      <thead>
        <tr class="bg-gray-200">
          <th class="p-2">No</th>
          <th class="p-2">Nama</th>
          <th class="p-2">NIK</th>
          <th class="p-2">Jenis Surat</th>
          <th class="p-2">Tanggal</th>
          <th class="p-2">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = $surat->fetch_assoc()): ?>
        <tr class="border-t">
          <td class="p-2"><?= $no++; ?></td>
          <td class="p-2"><?= $row['nama']; ?></td>
          <td class="p-2"><?= $row['nik']; ?></td>
          <td class="p-2"><?= $row['jenis_surat']; ?></td>
          <td class="p-2"><?= $row['tanggal_dibuat']; ?></td>
          <td class="p-2">
            <a href="surat_generated?id=<?= $row['id']; ?>" class="text-blue-500 hover:underline">Cetak</a>
            <span class="text-gray-300 mx-2">|</span>
            <a href="../proses/hapus_surat?id=<?= $row['id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
              Hapus
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
