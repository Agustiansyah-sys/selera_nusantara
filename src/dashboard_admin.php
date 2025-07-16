<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Admin - Selera Nusantara</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('uploads/dashboard admin.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.65);
            min-height: 100vh;
            padding-bottom: 60px;
        }
        .hero {
            padding: 60px 20px;
            text-align: center;
        }
        .hero h1 {
            font-size: 48px;
            font-weight: bold;
            color: #ffc107;
        }
        .hero p {
            font-size: 18px;
            color: #f8f9fa;
        }
        .btn-custom {
            font-size: 18px;
            padding: 14px 20px;
            border-radius: 12px;
            transition: 0.3s;
            font-weight: 600;
        }
        .btn-custom:hover {
            transform: scale(1.05);
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 22px;
        }
    </style>
</head>
<body>
<div class="overlay">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm px-3">
        <a class="navbar-brand text-dark" href="#">Selera Nusantara</a>
        <div class="ms-auto">
            <span class="text-dark me-3">👤 <?= htmlspecialchars($_SESSION['username']); ?> (Admin)</span>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <!-- Header -->
    <div class="hero">
        <h1>Dashboard Admin</h1>
        <p class="lead">Kelola semua data <strong>Selera Nusantara</strong> 🍽️</p>
    </div>

    <!-- Menu Admin -->
    <div class="container mt-4">
        <div class="row justify-content-center g-4">
            <div class="col-md-4">
                <a href="user.php" class="btn btn-secondary w-100 btn-custom">👥 Kelola User</a>
            </div>
            <div class="col-md-4">
                <a href="kategori.php" class="btn btn-warning w-100 btn-custom">📂 Kategori Menu</a>
            </div>
            <div class="col-md-4">
                <a href="menu.php" class="btn btn-primary w-100 btn-custom">🍱 Kelola Menu</a>
            </div>
            <div class="col-md-4">
                <a href="pesanan.php" class="btn btn-success w-100 btn-custom">🧾 Data Pesanan</a>
            </div>
            <div class="col-md-4">
                <a href="laporan.php" class="btn btn-dark w-100 btn-custom">📊 Laporan</a>
            </div>
        </div>
    </div>

</div>
</body>
</html>
