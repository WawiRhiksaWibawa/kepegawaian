<?php
include "koneksi.php";

$username = 'user1';
$password = 'user1';
$role = 'user';

// Hash password sebelum disimpan ke database
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$stmt = $kon->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $hashed_password, $role);
$stmt->execute();
$stmt->close();

echo "User baru berhasil dibuat!";
?>
