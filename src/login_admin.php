<?php
session_start();
include 'koneksi.php';

$error = "";

// Jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek user di database
    $q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password' AND role='admin'");
    
    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard_admin.php");
        exit;
    } else {
        $error = "❌ Username atau password salah, atau Anda bukan admin!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin - Selera Nusantara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('uploads/login admin.jpg') no-repeat center center fixed;
            background-size: cover;
            backdrop-filter: brightness(0.85);
        }
       
        .btn-nusantara {
            background-color: #f57c00;
            color: white;
            font-weight: bold;
        }
        .btn-nusantara:hover {
            background-color: #e65100;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center text-dark mb-4">Login Admin</h3>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="post">
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-nusantara w-100">🍽️ Masuk Dashboard</button>
        </form>

        <a href="index.php" class="d-block text-center mt-3 text-dark">← Kembali ke Beranda</a>
    </div>
</body>
</html>
