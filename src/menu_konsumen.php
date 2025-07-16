<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'konsumen') {
    header("Location: login_konsumen.php");
    exit;
}

$id_konsumen = $_SESSION['id_konsumen'];

$kategori_result = mysqli_query($koneksi, "SELECT * FROM kategori_menu");
$filter_kategori = isset($_GET['kategori']) ? $_GET['kategori'] : '';

if ($filter_kategori != '') {
    $stmt = mysqli_prepare($koneksi, "SELECT * FROM menu WHERE id_kategori = ? ORDER BY nama_menu ASC");
    mysqli_stmt_bind_param($stmt, "s", $filter_kategori);
    mysqli_stmt_execute($stmt);
    $menu_result = mysqli_stmt_get_result($stmt);
} else {
    $menu_result = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY nama_menu ASC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menu - Selera Nusantara</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('uploads/menu.jpg') no-repeat center center fixed;
      background-size: cover;
      position: relative;
    }
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(255, 255, 255, 0.85);
      z-index: 1;
    }
    .content-wrapper {
      position: relative;
      z-index: 2;
    }
    .menu-img {
      height: 250px;
      width: 100%;
      object-fit: contain;
      background-color: #ffffff;
      padding: 10px;
      border-bottom: 1px solid #dee2e6;
    }
    .card {
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 20px rgba(0,0,0,0.2);
    }
  </style>
</head>
<body>
<div class="overlay"></div>
<div class="content-wrapper p-4">
  <div class="container">
    <h3 class="text-center text-dark mb-4 fw-bold">🍽️ Daftar Menu <span class="text-primary">Selera Nusantara</span></h3>

    <!-- Filter Kategori -->
    <form method="get" class="row mb-4 justify-content-center">
      <div class="col-md-6">
        <select name="kategori" class="form-select" onchange="this.form.submit()">
          <option value="">-- Semua Kategori --</option>
          <?php while ($kat = mysqli_fetch_assoc($kategori_result)): ?>
            <option value="<?= $kat['id_kategori'] ?>" <?= ($filter_kategori == $kat['id_kategori']) ? 'selected' : '' ?>>
              <?= htmlspecialchars($kat['nama_kategori']) ?>
            </option>
          <?php endwhile; ?>
        </select>
      </div>
    </form>

    <div class="row">
      <?php while ($m = mysqli_fetch_assoc($menu_result)): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm">
            <img src="uploads/<?= htmlspecialchars($m['gambar']) ?>" class="card-img-top menu-img" alt="<?= htmlspecialchars($m['nama_menu']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($m['nama_menu']) ?></h5>
              <p class="text-danger fw-bold">Rp <?= number_format($m['harga'], 0, ',', '.') ?></p>
              <p class="text-muted small"><?= htmlspecialchars($m['deskripsi']) ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <div class="text-center mt-4">
      <a href="order.php" class="btn btn-success btn-lg me-2">🛒 Mulai Pemesanan</a>
      <a href="dashboard_konsumen.php" class="btn btn-secondary">⬅ Kembali ke Dashboard</a>
    </div>
  </div>
</div>
</body>
</html>
