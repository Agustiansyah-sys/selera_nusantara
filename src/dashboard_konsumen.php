<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'konsumen') {
    header("Location: login_konsumen.php");
    exit;
}

date_default_timezone_set("Asia/Makassar");
$tanggal = date("l, d F Y");
$waktu = date("H:i:s");
$nama_konsumen = htmlspecialchars($_SESSION['username']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Konsumen - Selera Nusantara</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('uploads/dashboard konsumen.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
      text-shadow: 1px 1px 4px rgba(0,0,0,0.7);
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.55);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      padding: 40px 20px;
      text-align: center;
    }

    .btn-custom {
      font-size: 1.1rem;
      padding: 12px 25px;
      border-radius: 30px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    .promo {
      background-color: rgba(255, 255, 255, 0.85);
      color: #b30000;
      font-weight: bold;
      border-radius: 10px;
      padding: 12px 20px;
      margin-top: 25px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    a.btn-outline-danger {
      margin-top: 30px;
      padding: 10px 20px;
      border-radius: 25px;
      border-width: 2px;
    }
  </style>
  <script>
    function updateWaktu() {
      const waktuEl = document.getElementById('waktu');
      const now = new Date();
      waktuEl.innerText = now.toLocaleTimeString('id-ID');
    }
    setInterval(updateWaktu, 1000);
  </script>
</head>
<body>
<div class="overlay">
  <h2 class="mb-3">👋 Selamat Datang, <strong><?= $nama_konsumen ?></strong>!</h2>
  <p>📅 <strong><?= $tanggal ?></strong> | ⏰ <strong id="waktu"><?= $waktu ?></strong></p>

  <div class="promo">
    🎉 Promo Hari Ini: Dapatkan <u>diskon 10%</u> untuk pembelian di atas <strong>Rp50.000</strong>!
  </div>

  <div class="d-flex justify-content-center gap-3 flex-wrap mt-4">
    <a href="menu_konsumen.php" class="btn btn-primary btn-custom">🍽️ Lihat Menu Makanan</a>
    <a href="order.php" class="btn btn-success btn-custom">🛒 Mulai Pemesanan</a>
  </div>

  <a href="logout.php" class="btn btn-outline-danger">🔒 Logout</a>
</div>
</body>
</html>
