<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard Admin - Desa Sumberjati</title>
  <link href="../aset/city-solid.svg" rel="icon" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <div class="max-w-4xl mx-auto mt-10 p-8 bg-white shadow-md rounded-lg">
    <h1 class="text-3xl font-bold mb-6">👋 Selamat Datang, <?= $_SESSION['admin']; ?>!</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <!-- Profil Desa -->
      <div class="p-6 border rounded-lg hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold mb-2">📌 Edit Profil Desa</h2>
        <p>Mengelola informasi lokasi, demografi, potensi, dan prestasi desa.</p>
        <div class="mt-4">
          <a href="tambah_profil" class="text-indigo-600 hover:text-indigo-800 font-semibold">Tambah Data Profil ➜</a> <br>
          <a href="lihat_profil" class="text-indigo-600 hover:text-indigo-800 font-semibold">Lihat Data Profil ➜</a>
        </div>
      </div>

      <!-- Surat -->
      <div class="p-6 border rounded-lg hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold mb-2">📄 Persuratan Otomatis</h2>
        <p>Input surat baru dan lihat arsip surat warga.</p>
        <div class="mt-4">
          <a href="tambah_surat" class="text-indigo-600 hover:text-indigo-800 font-semibold">Tambah Surat ➜</a><br>
          <a href="lihat_surat" class="text-indigo-600 hover:text-indigo-800 font-semibold">Lihat Semua Surat ➜</a>
        </div>
      </div>

      <!-- Kelola Admin -->
      <div class="p-6 border rounded-lg hover:shadow-lg transition-shadow duration-300">
        <h2 class="text-xl font-semibold mb-2">👤 Kelola Admin</h2>
        <p>Melihat dan menghapus akun admin yang terdaftar.</p>
        <a href="kelola_admin" class="text-indigo-600 hover:text-indigo-800 font-semibold mt-4 inline-block">Kelola Akun ➜</a>
      </div>

      <!-- Logout -->
      <div class="p-6 border rounded-lg hover:shadow-lg transition-shadow duration-300 bg-red-50">
        <h2 class="text-xl font-semibold mb-2">🚪 Keluar</h2>
        <p>Logout dari sistem admin.</p>
        <a href="logout" class="text-red-600 hover:text-red-800 font-semibold mt-4 inline-block">Logout ➜</a>
      </div>
    </div>
  </div>

</body>
</html>
