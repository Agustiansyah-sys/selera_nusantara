<?php
session_start();
if (isset($_SESSION['username'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selera Nusantara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container text-center mt-5">
        <h1 class="display-4">🍛 Selera Nusantara</h1>
        <p class="lead">Aneka Makanan Khas Indonesia</p>
        <a href="login.php" class="btn btn-primary mt-3">Login Admin</a>
        <a href="order.php" class="btn btn-success mt-3">Pesan Sekarang</a>
    </div>
</body>
</html>
