# Website Sistem Informasi Desa (Web Desa)

Aplikasi web sederhana untuk Sistem Informasi Desa yang dibangun menggunakan PHP native, MySQL, dan Tailwind CSS. Aplikasi ini bertujuan untuk mempermudah pengelolaan informasi desa dan pelayanan administrasi kepada masyarakat secara online.

![Tampilan Website Desa](./screenshot.png) 
*(Catatan: Anda bisa mengganti `screenshot.png` dengan screenshot tampilan website Anda)*

---

## 🚀 Fitur Utama

### Halaman Publik
-   **Beranda:** Tampilan utama dengan sambutan dan navigasi yang mudah digunakan.
-   **Profil Desa:** Menampilkan informasi dinamis mengenai desa seperti lokasi, demografi, potensi, dan prestasi. Seluruh konten dapat dikelola oleh admin.
-   **Layanan:** Daftar layanan yang disediakan oleh pemerintah desa.
-   **Pengajuan Surat:** Tautan untuk berbagai jenis pengajuan surat (contoh: Surat Domisili, Kelahiran, dll.).
-   **Desain Responsif:** Tampilan yang optimal di berbagai perangkat, baik desktop maupun mobile.

### Panel Admin
-   **Autentikasi Aman:** Sistem login dan registrasi untuk admin dengan *password hashing* untuk keamanan.
-   **Dashboard:** Halaman pusat untuk admin mengakses semua fitur pengelolaan.
-   **Manajemen Profil Desa (CRUD):**
    -   Admin dapat **menambah**, **melihat**, **mengubah**, dan **menghapus** konten profil desa.
    -   Mendukung fitur **unggah gambar** untuk melengkapi informasi.
-   **Persuratan Otomatis:**
    -   Membuat surat untuk warga (Surat Keterangan, Domisili, Usaha, dll.) melalui form.
    -   Data pengajuan surat tersimpan rapi di dalam database.
    -   Fitur **cetak surat** yang menghasilkan dokumen siap print sesuai template.
    -   Melihat dan menghapus arsip surat yang sudah dibuat.
-   **Manajemen Akun Admin:**
    -   Melihat daftar admin yang terdaftar.
    -   Menghapus akun admin lain (tidak bisa menghapus akun sendiri).

---

## 🛠️ Tumpukan Teknologi (Tech Stack)

-   **Backend:** PHP 7.4+ (Native/Prosedural & OOP)
-   **Database:** MySQL / MariaDB
-   **Frontend:**
    -   HTML5
    -   Tailwind CSS (via CDN)
    -   JavaScript (ES6)
-   **Web Server:** Apache (biasanya dari XAMPP atau Laragon)

---

## ⚙️ Instalasi dan Konfigurasi Lokal

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer Anda.

1.  **Prasyarat**
    -   Pastikan Anda sudah menginstal Web Server seperti XAMPP atau Laragon.
    -   PHP 7.4 atau versi lebih baru.
    -   MySQL atau MariaDB.

2.  **Clone Repositori**
    Buka terminal atau Git Bash, lalu clone repositori ini:
    ```bash
    git clone https://github.com/Rizkuy01/webdesa-cipancur.git
    ```
    Masuk ke direktori proyek:
    ```bash
    cd webdesa-cipancur
    ```

3.  **Pengaturan Database**
    -   Buka `phpMyAdmin` (atau *tool* database lain).
    -   Buat database baru dengan nama `web-desa`.
    -   Pilih database `web-desa`, lalu buka tab **SQL** dan jalankan query berikut untuk membuat tabel yang dibutuhkan:

    ```sql
    -- Tabel untuk akun admin
    CREATE TABLE `admin` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`),
      UNIQUE KEY `username` (`username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- Tabel untuk konten profil desa
    CREATE TABLE `profil_desa` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `kategori` varchar(50) NOT NULL,
      `judul` varchar(255) NOT NULL,
      `deskripsi` text NOT NULL,
      `foto` varchar(255) DEFAULT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

    -- Tabel untuk arsip surat
    CREATE TABLE `surat` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `nama` varchar(255) NOT NULL,
      `nik` varchar(16) NOT NULL,
      `jenis_surat` varchar(100) NOT NULL,
      `keperluan` text NOT NULL,
      `tanggal_dibuat` timestamp NOT NULL DEFAULT current_timestamp(),
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ```

4.  **Konfigurasi Koneksi Database**
    -   Buka file `config/db.php`.
    -   Sesuaikan detail koneksi (`$host`, `$user`, `$pass`, `$db`) jika berbeda dari *default*.

    ```php
    <?php
    $host = "localhost";
    $user = "root";
    $pass = ""; // Sesuaikan jika password root Anda berbeda
    $db = "web-desa";

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
      die("Koneksi gagal: " . $conn->connect_error);
    }
    ?>
    ```

5.  **Jalankan Aplikasi**
    -   Letakkan folder proyek di dalam direktori `htdocs` (untuk XAMPP) atau `www` (untuk Laragon).
    -   Buka browser dan akses URL: `http://localhost/webdesa-cipancur/` (sesuaikan `webdesa-cipancur` dengan nama folder Anda).
    -   Untuk masuk ke panel admin, akses: `http://localhost/webdesa-cipancur/admin/login`

---

## 🏛️ Struktur Direktori

```
.
├── admin/            # Halaman-halaman panel admin (login, dashboard, dll.)
├── aset/             # File aset statis (gambar, ikon)
├── config/           # Konfigurasi aplikasi (koneksi database)
├── js/               # File JavaScript
├── proses/           # Logika backend untuk pemrosesan form (CRUD, login)
├── .htaccess         # Konfigurasi URL-rewrite untuk URL yang lebih bersih
├── index.php         # Halaman utama (publik)
└── README.md         # File dokumentasi ini
```