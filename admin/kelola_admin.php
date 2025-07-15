<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login");
  exit;
}
include '../config/db.php';

$current_admin_id = $_SESSION['admin_id'];
$admins = $conn->query("SELECT id, username, created_at FROM admin");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kelola Akun Admin - Admin</title>
  <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 text-gray-800 p-10">

  <div class="max-w-4xl mx-auto bg-white p-8 shadow-md rounded-lg">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold text-gray-900">Kelola Akun Admin</h2>
        <a href="dashboard" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition-colors">
            &larr; Kembali ke Dashboard
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
          <thead>
            <tr class="bg-gray-200 text-left">
              <th class="p-3">ID</th>
              <th class="p-3">Username</th>
              <th class="p-3">Tanggal Dibuat</th>
              <th class="p-3">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if ($admins->num_rows > 0): ?>
                <?php while ($row = $admins->fetch_assoc()): ?>
                <tr class="border-t hover:bg-gray-50">
                  <td class="p-3"><?= $row['id']; ?></td>
                  <td class="p-3"><?= htmlspecialchars($row['username']); ?></td>
                  <td class="p-3"><?= date('d M Y, H:i', strtotime($row['created_at'])); ?></td>
                  <td class="p-3">
                    <?php if ($row['id'] != $current_admin_id): ?>
                        <a href="../proses/hapus_admin?id=<?= $row['id']; ?>" class="text-red-600 hover:text-red-800 font-medium" onclick="return confirm('Apakah Anda yakin ingin menghapus admin ini? Aksi ini tidak dapat dibatalkan.');">Hapus</a>
                    <?php else: ?>
                        <span class="text-gray-400 cursor-not-allowed">Ini Anda</span>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php endwhile; ?>
            <?php endif; ?>
          </tbody>
        </table>
    </div>
  </div>

</body>
</html>