<?php
include 'config/db.php';

// Fetch all profiles, ordered by the newest first
$profiles_result = $conn->query("SELECT id, kategori, judul, deskripsi, foto FROM profil_desa ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Desa Cipancur | Website</title>
  <link href="aset/city-solid.svg" rel="icon" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body>
  <div class="container max-w-screen">
    <header class="bg-slate-800 text-white sticky top-0 z-50">
      <div class="header-content flex justify-between items-center max-w-screen-xl mx-auto px-4 py-3">
        <div class="logo flex items-center gap-4">
          <span class="text-4xl text-white"><i class="fa-solid fa-city"></i></span>
          <div>
            <h1 class="text-lg font-bold">Desa Sumberjati</h1>
            <small class="text-sm">Portal Resmi Pemerintah Desa</small>
          </div>
        </div>
        <nav>
          <ul class="flex gap-6 text-sm font-medium">
            <li><a href="#home" class="hover:text-blue-300">Beranda</a></li>
            <li><a href="#profile" class="hover:text-blue-300">Profil</a></li>
            <li><a href="#services" class="hover:text-blue-300">Layanan</a></li>
            <li><a href="#pengajuan-surat" class="hover:text-blue-300">Pengajuan Surat</a></li>
            <li><a href="admin/login" target="_blank" class="hover:text-blue-300">Admin</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <section id="home" class="scroll-mt-24 bg-gradient-to-r from-slate-700 to-indigo-800 text-white py-24 text-center min-h-screen flex items-center justify-center">
      <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-4xl md:text-5xl font-bold mb-4 drop-shadow-lg">Selamat Datang di Portal Resmi Desa Sumberjati</h2>
        <p class="text-lg md:text-xl mb-6 text-gray-200">Pelayanan Administrasi Desa Lebih Mudah dan Cepat</p>
        <a href="#pengajuan-surat"
          class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 px-8 rounded-full shadow transition duration-300">
          Mulai Pengajuan Surat
        </a>
      </div>
    </section>

    <section id="profile" class="scroll-mt-26 bg-gradient-to-r from-slate-700 to-indigo-800 text-white py-24 text-center">
      <h3 class="text-2xl mb-8 text-white text-center font-semibold"><i class="fas fa-users"></i> Profil Desa Sumberjati</h3>

      <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <?php if ($profiles_result && $profiles_result->num_rows > 0): ?>
          <?php while ($profil = $profiles_result->fetch_assoc()): ?>
            <div class="bg-gray-100 p-6 rounded-[15px] shadow-md hover:-translate-y-1 transition-transform">
              <div class="relative mb-4">
                <?php if (!empty($profil['foto'])): ?>
                  <img src="aset/<?= htmlspecialchars($profil['foto']); ?>" alt="<?= htmlspecialchars($profil['judul']); ?>"
                    class="w-full h-[200px] object-cover rounded">
                <?php else: ?>
                  <div class="w-full h-[200px] bg-gray-100 rounded flex items-center justify-center">
                    <i class="fas fa-image fa-3x text-gray-400"></i>
                  </div>
                <?php endif; ?>
              </div>
              <h4 class="text-lg font-semibold text-[#2c3e50] mb-2"><?= htmlspecialchars($profil['judul']); ?> - Desa Sumberjati</h4>
              <p class="text-sm text-gray-700"><?= nl2br(htmlspecialchars($profil['deskripsi'])); ?></p>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="col-span-full text-center text-gray-500">Belum ada data profil yang ditambahkan.</p>
        <?php endif; ?>
      </div>
    </section>

    <section id="services" class="scroll-mt-16 bg-gradient-to-r from-slate-700 to-indigo-800 text-white py-24 text-center">
      <h3 class="text-2xl mb-8 text-white text-center font-semibold">
        <i class="fas fa-cogs"></i> Layanan Desa Sumberjati
      </h3>
      <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <!-- Kartu 1: Surat Keterangan -->
        <div
          class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-blue-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-id-card text-6xl text-blue-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Surat Keterangan
          </h4>
          <p class="text-sm text-gray-600">
            Pengurusan surat keterangan domisili, kelahiran, kematian, dan berbagai surat administrasi lainnya.
          </p>
        </div>

        <!-- Kartu 2: Layanan Kependudukan (Contoh Baru) -->
        <div
          class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-green-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-users text-6xl text-green-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Layanan Kependudukan
          </h4>
          <p class="text-sm text-gray-600">
            Pembuatan KTP, Kartu Keluarga, dan dokumen kependudukan lainnya.
          </p>
        </div>

        <!-- 3. Kartu Pengaduan Masyarakat -->
        <div class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-red-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-bullhorn text-6xl text-red-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Pengaduan Masyarakat
          </h4>
          <p class="text-sm text-gray-600">
            Sampaikan aspirasi, keluhan, dan laporan Anda secara online kepada kami.
          </p>
        </div>

        <!-- 4. Kartu Informasi Publik -->
        <div
          class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-yellow-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-info-circle text-6xl text-yellow-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Informasi Publik
          </h4>
          <p class="text-sm text-gray-600">
            Akses informasi transparan mengenai anggaran, program, dan kegiatan desa.
          </p>
        </div>

        <!-- 5. Kartu Potensi Desa -->
        <div
          class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-purple-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-leaf text-6xl text-purple-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Potensi Desa
          </h4>
          <p class="text-sm text-gray-600">
            Jelajahi potensi wisata, pertanian, dan UMKM yang ada di desa kami.
          </p>
        </div>

        <!-- 6. Kartu Produk Hukum -->
        <div
          class="bg-white p-6 rounded-lg shadow hover:-translate-y-1 transition-transform border-l-4 border-gray-500">
          <div class="flex justify-center mb-4">
            <i class="fas fa-gavel text-6xl text-gray-500"></i>
          </div>
          <h4 class="text-base font-semibold mb-2">
            Produk Hukum
          </h4>
          <p class="text-sm text-gray-600">
            Unduh peraturan desa, surat keputusan, dan produk hukum lainnya.
          </p>
        </div>
      </div>
    </section>

    <section id="pengajuan-surat" class="scroll-mt-16 bg-gradient-to-r from-slate-700 to-indigo-800 text-white py-24 text-center">
      <h3 class="text-2xl mb-8 text-white text-center font-semibold"><i class="fas fa-envelope-open-text"></i>
        Pengajuan Surat Desa Sumberjati</h3>
      <div class="max-w-6xl mx-auto grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">

        <!-- Surat Domisili -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-blue-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-home text-5xl text-blue-600 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Surat Domisili</h4>
          <p class="text-gray-700 text-sm">Ajukan surat keterangan domisili secara online dengan cepat dan mudah.</p>
        </a>

        <!-- Surat Kelahiran -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-green-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-baby text-5xl text-green-600 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Surat Kelahiran</h4>
          <p class="text-gray-700 text-sm">Formulir pengajuan surat keterangan kelahiran anak Anda.</p>
        </a>

        <!-- Surat Kematian -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-red-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-book-dead text-5xl text-gray-700 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Surat Kematian</h4>
          <p class="text-gray-700 text-sm">Ajukan surat keterangan kematian secara resmi dan cepat.</p>
        </a>

        <!-- Surat Usaha -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-yellow-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-briefcase text-5xl text-yellow-500 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Surat Usaha</h4>
          <p class="text-gray-700 text-sm">Formulir pendaftaran izin usaha mikro atau UMKM Anda.</p>
        </a>

        <!-- Pengantar KTP -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-indigo-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-id-card text-5xl text-indigo-500 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Pengantar KTP</h4>
          <p class="text-gray-700 text-sm">Ajukan surat pengantar untuk pembuatan KTP.</p>
        </a>

        <!-- Surat Nikah -->
        <a href="..." target="_blank"
          class="bg-gray-100 hover:bg-pink-50 transition duration-300 cursor-pointer text-center p-6 rounded-[15px] shadow-md hover:-translate-y-1 transform block">
          <i class="fas fa-heart text-5xl text-pink-500 mb-4"></i>
          <h4 class="text-xl font-semibold text-[#2c3e50] mb-2">Surat Nikah</h4>
          <p class="text-gray-700 text-sm">Ajukan permohonan surat nikah secara online dengan mudah dan cepat.</p>
        </a>
      </div>
    </section>

    <footer class="scroll-mt-16 bg-gradient-to-r from-slate-700 to-indigo-800 text-white py-24 text-center">
      <p>&copy; Desa Sumberjati 2025.</p>
      <p>Kec. Mekarsari, Kab. Bekasi</p>
      <p>Telp: (021) 1234-5678 | Email: info@sumberjati.desa.id</p>
    </footer>
  </div>

  <script src="./js/script.js"></script>
</body>

</html>