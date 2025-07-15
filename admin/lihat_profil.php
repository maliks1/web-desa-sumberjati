<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}
include '../config/db.php';
// Assuming the table for profiles is named 'profil_desa'
$profiles = $conn->query("SELECT id, kategori, judul, deskripsi, foto FROM profil_desa ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lihat Profil Desa - Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-10">

  <div class="max-w-5xl mx-auto bg-white p-6 shadow-md rounded-lg">
  <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Kelola Profil Desa</h2>
        <a href="dashboard" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>
    <h2 class="text-2xl font-bold mb-4">📋 Daftar Item Profil Desa</h2>
    <div class="overflow-x-auto">
      <table class="w-full table-auto border-collapse">
      <thead>
        <tr class="bg-gray-200 text-left">
          <th class="p-3">ID</th>
          <th class="p-3">Kategori</th>
          <th class="p-3">Judul</th>
          <th class="p-3">Deskripsi</th>
          <th class="p-3">Foto</th>
          <th class="p-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($profiles && $profiles->num_rows > 0): ?>
          <?php while ($row = $profiles->fetch_assoc()): ?>
          <tr class="border-t hover:bg-gray-50">
            <td class="p-3 align-top"><?= $row['id']; ?></td>
            <td class="p-3 align-top"><?= htmlspecialchars(ucfirst($row['kategori'])); ?></td>
            <td class="p-3 align-top font-semibold"><?= htmlspecialchars($row['judul']); ?></td>
            <td class="p-3 align-top text-sm text-gray-600"><?= htmlspecialchars(substr($row['deskripsi'], 0, 150)); ?><?= strlen($row['deskripsi']) > 150 ? '...' : '' ?></td>
            <td class="p-3 align-top">
              <?php if (!empty($row['foto'])): ?>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Ada</span>
              <?php else: ?>
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Tidak ada</span>
              <?php endif; ?>
            </td>
            <td class="p-3 align-top whitespace-nowrap">
              <a href="edit_profil?id=<?= $row['id']; ?>" class="text-indigo-600 hover:text-indigo-800 font-medium">Edit</a>
              <span class="mx-1 text-gray-300">|</span>
              <a href="../proses/hapus_profil?id=<?= $row['id']; ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus item profil ini?');">Hapus</a>
            </td>
          </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr class="border-t">
            <td colspan="6" class="p-3 text-center text-gray-500">Belum ada data profil yang ditambahkan.</td>
          </td>
        </tr>
        <?php endif; ?>
      </tbody>
    </table>
    </div>
  </div>

</body>
</html>
