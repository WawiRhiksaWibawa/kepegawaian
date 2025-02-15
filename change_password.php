<?php
session_start();
include "koneksi.php";

// Periksa apakah pengguna sudah login dan berperan sebagai admin atau user
if (!isset($_SESSION['username'])) {
    echo "<script>alert('Anda harus login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

// Proses perubahan password
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_SESSION['username'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password baru dan konfirmasi sama
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Password baru dan konfirmasi tidak cocok!'); window.location.href='change_password.php';</script>";
        exit;
    }

    // Cek password lama
    $stmt = $kon->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user || !password_verify($old_password, $user['password'])) {
        echo "<script>alert('Password lama salah!'); window.location.href='change_password.php';</script>";
        exit;
    }

    // Update password baru
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    $stmt = $kon->prepare("UPDATE users SET password = ? WHERE username = ?");
    $stmt->bind_param("ss", $new_password_hashed, $username);
    if ($stmt->execute()) {
        echo "<script>alert('Password berhasil diubah!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal mengubah password!'); window.location.href='change_password.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center" style="height: 100vh; background: linear-gradient(135deg, #FF6B6B, #6BCB77);">
    <div class="card p-4 shadow-lg" style="width: 400px; border-radius: 20px;">
        <h4 class="text-center mb-4 text-primary"><i class="fas fa-lock"></i> Ganti Password</h4>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="old_password" class="form-label">Password Lama</label>
                <input type="password" name="old_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="new_password" class="form-label">Password Baru</label>
                <input type="password" name="new_password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="confirm_password" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ubah Password</button>
        </form>
    </div>
</body>
</html>
