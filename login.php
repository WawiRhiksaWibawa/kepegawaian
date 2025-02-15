<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kepegawaian App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #6e45e2, #88d3ce);
            color: #fff;
            margin: 0;
        }
        .login-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 400px;
        }
        .login-card h3 {
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
        .login-btn, .register-btn {
            width: 100%;
            margin-top: 10px;
            font-weight: bold;
            border: none;
        }
        .login-btn {
            background-color: #fff;
            color: #6e45e2;
        }
        .login-btn:hover {
            background-color: #f0f0f0;
        }
        .register-btn {
            background-color: #88d3ce;
            color: #fff;
        }
        .register-btn:hover {
            background-color: #6e45e2;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h3><i class="fas fa-user-lock"></i> Login</h3>
        <form action="authenticate.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn login-btn">Login</button>
        </form>
        <a href="register.php" class="btn register-btn mt-3">Daftar Baru</a>
    </div>
</body>
</html>
