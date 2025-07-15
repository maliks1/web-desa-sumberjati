<?php
session_start();
include '../config/db.php';

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement untuk keamanan
$stmt = $conn->prepare("SELECT id, username, password FROM admin WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$stmt->close();

if ($data && password_verify($password, $data['password'])) {
  $_SESSION['admin'] = $data['username'];
  $_SESSION['admin_id'] = $data['id']; // Simpan ID admin di session
  header("Location: ../admin/dashboard");
} else {
  $_SESSION['error'] = "Login gagal. Cek kembali username/password.";
  header("Location: ../admin/login");
}
