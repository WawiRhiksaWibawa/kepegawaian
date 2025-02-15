<?php
session_start();
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user'; // Default role sebagai user

    // Cek apakah username sudah terdaftar
    $stmt = $kon->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<div class='alert alert-danger'>Username sudah digunakan!</div>";
    } else {
        // Insert user baru
        $stmt = $kon->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $role);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Pendaftaran berhasil! Silakan <a href='login.php'>login</a>.</div>";
        } else {
            echo "<div class='alert alert-danger'>Pendaftaran gagal!</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran - Kepegawaian App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #88d3ce, #6e45e2);
            color: #fff;
            margin: 0;
        }
        .register-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        .register-card h3 {
            margin-bottom: 20px;
            text-align: center;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: #fff;
        }
        .form-control::placeholder {
            color: #ddd;
        }
        .register-btn {
            width: 100%;
            background-color: #fff;
            color: #88d3ce;
            font-weight: bold;
            border: none;
        }
        .register-btn:hover {
            background-color: #f0f0f0;
            color: #6e45e2;
        }
    </style>
</head>
<body>
    <div class="register-card">
        <h3><i class="fas fa-user-plus"></i> Pendaftaran</h3>
        <form action="register.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn register-btn">Daftar</button>
        </form>
        <a href="login.php" class="btn btn-light mt-3">Kembali ke Login</a>
    </div>
</body>
</html>
