<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}
include '../config/db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Profil Desa - Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-2xl mx-auto mt-10 p-8 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Tambah Profil Desa Baru</h2>

    <form action="../proses/simpan_profil" method="POST" enctype="multipart/form-data" class="space-y-4">

      <div>
        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <select id="kategori" name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
          <option value="" disabled selected>-- Pilih Kategori --</option>
          <option value="lokasi">Lokasi & Geografis</option>
          <option value="demografi">Demografi</option>
          <option value="potensi">Potensi Desa</option>
          <option value="prestasi">Prestasi</option>
        </select>
      </div>

      <div>
        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
        <input type="text" id="judul" name="judul" required placeholder="Contoh: Pertanian Padi Organik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
      </div>

      <div>
        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" required placeholder="Jelaskan secara singkat tentang item profil ini..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"></textarea>
      </div>

      <div>
        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1">Upload Foto (Opsional)</label>
        <input type="file" id="foto" name="foto" accept="image/jpeg, image/png, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-indigo-50 file:text-indigo-600 file:text-sm file:font-semibold file:border-0 file:py-2 file:px-4 file:mr-4 hover:file:bg-indigo-100">
        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau GIF. Ukuran maks: 2MB.</p>
      </div>

      <div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
          Simpan Data
        </button>
      </div>
    </form>

    <div class="mt-6 text-center">
        <a href="dashboard" class="text-sm text-indigo-600 hover:text-indigo-500">
            &larr; Kembali ke Dashboard
        </a>
    </div>

  </div>
</body>
</html>