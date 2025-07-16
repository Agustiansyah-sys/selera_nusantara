<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login_admin.php");
    exit;
}

$tanggal_awal = $_GET['tanggal_awal'] ?? '';
$tanggal_akhir = $_GET['tanggal_akhir'] ?? '';

$query = "
    SELECT 
        p.id_konsumen,
        GROUP_CONCAT(CONCAT(m.nama_menu, ' (', p.jumlah, ')') SEPARATOR ', ') AS pesanan,
        p.layanan,
        p.no_meja,
        p.pengambilan,
        p.pembayaran,
        DATE(p.tanggal_pesan) AS tanggal
    FROM pesanan p
    JOIN menu m ON p.id_menu = m.id_menu
";

if ($tanggal_awal && $tanggal_akhir) {
    $query .= " WHERE DATE(p.tanggal_pesan) BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
}

$query .= "
    GROUP BY p.id_konsumen, p.layanan, p.no_meja, p.pengambilan, p.pembayaran, DATE(p.tanggal_pesan)
    ORDER BY p.tanggal_pesan DESC
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('uploads/background admin.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        .overlay {
            background: rgba(255, 255, 255, 0.96);
            padding: 30px;
            border-radius: 16px;
            margin-top: 30px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.15);
        }

        h3 {
            color: #d63384;
            font-weight: bold;
        }

        .card-laporan {
            background-color: #fffefc;
            border-left: 6px solid #0d6efd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .badge-info {
            background-color: #0dcaf0;
            color: #000;
        }

        .badge-light {
            background-color: #f8f9fa;
            color: #000;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .form-control, .btn {
            border-radius: 8px;
        }
    </style>
</head>
<body class="p-4">
<div class="container">
    <div class="overlay">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>🧾 Laporan Pesanan</h3>
            <a href="dashboard_admin.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
        </div>

        <!-- Filter Tanggal -->
        <form method="get" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="date" name="tanggal_awal" class="form-control" value="<?= $tanggal_awal ?>">
            </div>
            <div class="col-md-4">
                <input type="date" name="tanggal_akhir" class="form-control" value="<?= $tanggal_akhir ?>">
            </div>
            <div class="col-md-4 d-flex gap-2">
                <button type="submit" class="btn btn-primary">🔍 Filter</button>
                <a href="laporan.php" class="btn btn-secondary">🔄 Reset</a>
            </div>
        </form>

        <!-- Tombol Hapus -->
        <a href="hapus_semua_pesanan.php" class="btn btn-danger mb-4"
           onclick="return confirm('Yakin ingin menghapus semua data?')">
           🗑 Hapus Semua
        </a>

        <!-- Kartu Pesanan -->
        <?php 
        $no = 1;
        $ada_data = false;
        while ($row = mysqli_fetch_assoc($result)): 
            $ada_data = true;
        ?>
            <div class="card-laporan">
                <h5>👤 Konsumen #<?= $row['id_konsumen'] ?> — <?= $row['tanggal'] ?></h5>
                <p><strong>📝 Pesanan:</strong> <?= $row['pesanan'] ?></p>
                <p>
                    <span class="badge bg-info text-dark"><?= strtoupper($row['layanan']) ?></span>
                    <?php if ($row['layanan'] === 'dine-in'): ?>
                        <span class="badge bg-secondary">No Meja: <?= $row['no_meja'] ?></span>
                    <?php endif; ?>
                    <span class="badge bg-warning text-dark">Pengambilan: <?= $row['pengambilan'] ?></span>
                    <span class="badge bg-success">Bayar: <?= $row['pembayaran'] ?></span>
                </p>
            </div>
        <?php 
            $no++;
        endwhile;

        if (!$ada_data): ?>
            <div class="alert alert-warning text-center">
                Tidak ada data pesanan pada rentang tanggal tersebut.
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>
