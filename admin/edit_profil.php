<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login");
  exit;
}
include '../config/db.php';

// Initialize variables
$is_edit_mode = false;
$profil_id = null;
$kategori = '';
$judul = '';
$deskripsi = '';
$foto = '';

// Check if an ID is passed for editing
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $is_edit_mode = true;
    $profil_id = $_GET['id'];

    // Fetch existing data from the database using prepared statements
    $stmt = $conn->prepare("SELECT kategori, judul, deskripsi, foto FROM profil_desa WHERE id = ?");
    $stmt->bind_param("i", $profil_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $profil = $result->fetch_assoc();
        $kategori = $profil['kategori'];
        $judul = $profil['judul'];
        $deskripsi = $profil['deskripsi'];
        $foto = $profil['foto'];
    } else {
        // If ID not found, redirect to the list page with an error message
        $_SESSION['error'] = "Data profil tidak ditemukan.";
        header("Location: lihat_profil");
        exit;
    }
    $stmt->close();
}

// Determine page title, button text, and form action based on mode
$page_title = $is_edit_mode ? "Edit Profil Desa" : "Tambah Profil Desa";
$button_text = $is_edit_mode ? "Update Data" : "Simpan Data";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $page_title ?> - Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800">
  <div class="max-w-2xl mx-auto mt-10 p-8 bg-white shadow-md rounded-lg">
    <h2 class="text-2xl font-bold text-gray-900 mb-6"><?= $page_title ?></h2>

    <?php if (isset($_SESSION['msg'])): ?>
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['msg']); unset($_SESSION['msg']); ?></span>
      </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></span>
      </div>
    <?php endif; ?>

    <form action="../proses/simpan_profil" method="POST" enctype="multipart/form-data" class="space-y-4">
      <?php if ($is_edit_mode): ?>
        <input type="hidden" name="id" value="<?= $profil_id ?>">
        <input type="hidden" name="foto_lama" value="<?= htmlspecialchars($foto) ?>">
      <?php endif; ?>

      <div>
        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <select id="kategori" name="kategori" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
          <option value="lokasi" <?= ($kategori == 'lokasi') ? 'selected' : '' ?>>Lokasi & Geografis</option>
          <option value="demografi" <?= ($kategori == 'demografi') ? 'selected' : '' ?>>Demografi</option>
          <option value="potensi" <?= ($kategori == 'potensi') ? 'selected' : '' ?>>Potensi Desa</option>
          <option value="prestasi" <?= ($kategori == 'prestasi') ? 'selected' : '' ?>>Prestasi</option>
        </select>
      </div>

      <div>
        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
        <input type="text" id="judul" name="judul" value="<?= htmlspecialchars($judul) ?>" required placeholder="Contoh: Pertanian Padi Organik" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
      </div>

      <div>
        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi" rows="5" required placeholder="Jelaskan secara singkat tentang item profil ini..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all"><?= htmlspecialchars($deskripsi) ?></textarea>
      </div>

      <div>
        <label for="foto" class="block text-sm font-medium text-gray-700 mb-1"><?= $is_edit_mode ? 'Ganti Foto (Opsional)' : 'Upload Foto (Opsional)' ?></label>
        <?php if ($is_edit_mode && !empty($foto)): ?>
          <div class="mb-2">
            <p class="text-xs text-gray-600">Foto Saat Ini:</p>
            <img src="../aset/<?= htmlspecialchars($foto) ?>" alt="Foto saat ini" class="mt-1 h-24 w-24 object-cover rounded-md border">
          </div>
        <?php endif; ?>
        <input type="file" id="foto" name="foto" accept="image/jpeg, image/png, image/gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-indigo-50 file:text-indigo-600 file:text-sm file:font-semibold file:border-0 file:py-2 file:px-4 file:mr-4 hover:file:bg-indigo-100">
        <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, atau GIF. Ukuran maks: 2MB.</p>
      </div>

      <div>
        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 rounded-lg transition-colors">
          <?= $button_text ?>
        </button>
      </div>
    </form>

    <div class="mt-6 text-center">
        <a href="lihat_profil" class="text-sm text-indigo-600 hover:text-indigo-500">
            &larr; Kembali ke Daftar Profil
        </a>
    </div>

  </div>
</body>
</html>
