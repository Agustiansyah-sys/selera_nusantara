<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'konsumen') {
    header("Location: login_konsumen.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Pemesanan Menu</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(rgba(255,255,255,0.8), rgba(255,255,255,0.9)), url('uploads/order.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Segoe UI', sans-serif;
    }

    .form-title {
      font-weight: bold;
      text-align: center;
      margin-top: 40px;
      color: #212529;
    }

    label {
      font-weight: 500;
    }

    .btn-outline-secondary {
      border-radius: 30px;
    }

    .form-select, .form-control {
      border-radius: 10px;
    }

    .btn-primary {
      border-radius: 30px;
      font-size: 1.1rem;
      padding: 10px 20px;
    }
  </style>

  <script>
    function tambahMenu() {
      const container = document.getElementById('menu-list');
      const item = container.firstElementChild.cloneNode(true);
      container.appendChild(item);
    }

    function toggleMetode() {
      const metode = document.querySelector('select[name="metode"]').value;
      document.getElementById('dinein-form').style.display = (metode === 'dine-in') ? 'block' : 'none';
      document.getElementById('takeaway-form').style.display = (metode === 'takeaway') ? 'block' : 'none';
    }
  </script>
</head>
<body>

<div class="container py-4 px-3 px-md-5">
  <h2 class="form-title mb-4">📝 Form Pemesanan Menu</h2>

  <form action="proses_pemesanan.php" method="post" class="row justify-content-center">
    <div id="menu-list">
      <div class="row g-3 mb-3">
        <div class="col-md-7">
          <label class="form-label">Menu:</label>
          <select name="id_menu[]" class="form-select" required>
            <option value="">-- Pilih Menu --</option>
            <?php
            $menu = mysqli_query($koneksi, "SELECT * FROM menu ORDER BY nama_menu ASC");
            while ($row = mysqli_fetch_assoc($menu)) {
                echo "<option value='{$row['id_menu']}'>{$row['nama_menu']} - Rp " . number_format($row['harga'], 0, ',', '.') . "</option>";
            }
            ?>
          </select>
        </div>
        <div class="col-md-5">
          <label class="form-label">Jumlah:</label>
          <input type="number" name="jumlah[]" class="form-control" required min="1" value="1">
        </div>
      </div>
    </div>

    <div class="mb-3 text-center">
      <button type="button" class="btn btn-outline-secondary" onclick="tambahMenu()">+ Tambah Menu</button>
    </div>

    <div class="mb-3 col-md-8">
      <label class="form-label">Metode Pengambilan:</label>
      <select name="metode" class="form-select" required onchange="toggleMetode()">
        <option value="">-- Pilih Metode --</option>
        <option value="dine-in">Dine-in</option>
        <option value="takeaway">Takeaway</option>
      </select>
    </div>

    <div id="dinein-form" class="mb-3 col-md-8" style="display: none;">
      <label class="form-label">Nomor Meja:</label>
      <input type="text" name="nomor_meja" class="form-control" placeholder="Contoh: A12">
    </div>

    <div id="takeaway-form" class="mb-3 col-md-8" style="display: none;">
      <label class="form-label">Pengambilan:</label>
      <select name="pengambilan" class="form-select">
        <option value="">-- Pilih --</option>
        <option value="ambil_sendiri">Ambil Sendiri</option>
        <option value="kurir">Pakai Kurir</option>
      </select>
    </div>

    <div class="mb-3 col-md-8">
      <label class="form-label">Metode Pembayaran:</label>
      <select name="pembayaran" class="form-select" required>
        <option value="">-- Pilih Pembayaran --</option>
        <option value="qris">QRIS</option>
        <option value="transfer">Transfer</option>
        <option value="tunai">Tunai</option>
      </select>
    </div>

    <div class="col-md-8 text-center mt-3">
      <button type="submit" class="btn btn-primary">✅ Pesan & Cetak Struk</button>
    </div>
  </form>
</div>

</body>
</html>
