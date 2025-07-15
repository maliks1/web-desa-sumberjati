<?php
session_start();
include '../config/db.php';

// 1. Authenticate: Pastikan admin sudah login
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin/login");
    exit;
}

// 2. Pastikan request adalah POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../admin/dashboard");
    exit;
}

// 3. Ambil data dari form
$kategori = $_POST['kategori'];
$judul = $_POST['judul'];
$deskripsi = $_POST['deskripsi'];
$id = isset($_POST['id']) ? (int)$_POST['id'] : null;
$foto_lama = isset($_POST['foto_lama']) ? $_POST['foto_lama'] : '';

$foto_final = $foto_lama; // Secara default, gunakan foto lama

// 4. Proses Upload File (jika ada file baru)
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['foto'];
    $upload_dir = '../aset/';
    $max_size = 2 * 1024 * 1024; // 2MB
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    
    // Validasi Tipe File (MIME type lebih aman daripada ekstensi)
    $file_type = mime_content_type($file['tmp_name']);
    if (!in_array($file_type, $allowed_types)) {
        $_SESSION['error'] = "Format file tidak diizinkan. Harap unggah file JPG, PNG, atau GIF.";
        header("Location: ../admin/edit_profil" . ($id ? "?id=$id" : ""));
        exit;
    }

    // Validasi Ukuran File
    if ($file['size'] > $max_size) {
        $_SESSION['error'] = "Ukuran file terlalu besar. Maksimal 2MB.";
        header("Location: ../admin/edit_profil" . ($id ? "?id=$id" : ""));
        exit;
    }

    // Buat nama file unik dan pindahkan
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $foto_baru = time() . '-' . bin2hex(random_bytes(8)) . '.' . $file_extension;
    $lokasi_baru = rtrim($upload_dir, '/') . '/' . $foto_baru;

    if (move_uploaded_file($file['tmp_name'], $lokasi_baru)) {
        $foto_final = $foto_baru; // Gunakan foto baru
        // Jika ini adalah update, hapus foto lama
        if ($id && !empty($foto_lama) && file_exists($upload_dir . $foto_lama)) {
            unlink($upload_dir . $foto_lama);
        }
    } else {
        $_SESSION['error'] = "Gagal memindahkan file yang diunggah.";
        header("Location: ../admin/edit_profil" . ($id ? "?id=$id" : ""));
        exit;
    }
}

// 5. Operasi Database (UPDATE atau INSERT) dengan Prepared Statements
$is_update = !is_null($id);
$sql = $is_update 
    ? "UPDATE profil_desa SET kategori = ?, judul = ?, deskripsi = ?, foto = ? WHERE id = ?"
    : "INSERT INTO profil_desa (kategori, judul, deskripsi, foto) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$is_update ? $stmt->bind_param("ssssi", $kategori, $judul, $deskripsi, $foto_final, $id)
           : $stmt->bind_param("ssss", $kategori, $judul, $deskripsi, $foto_final);

if ($stmt->execute()) {
    $_SESSION['msg'] = $is_update ? "Data profil berhasil diperbarui!" : "Data profil berhasil disimpan!";
    header("Location: ../admin/lihat_profil");
} else {
    $_SESSION['error'] = "Operasi database gagal: " . $stmt->error;
    header("Location: ../admin/edit_profil" . ($id ? "?id=$id" : ""));
}

$stmt->close();
$conn->close();
exit;
