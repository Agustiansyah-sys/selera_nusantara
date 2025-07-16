<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login_admin.php");
    exit;
}

$today = date('Y-m-d');

// Ambil data pesanan hari ini, digroup per konsumen
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
    WHERE DATE(p.tanggal_pesan) = '$today'
    GROUP BY p.id_konsumen, p.layanan, p.no_meja, p.pengambilan, p.pembayaran, DATE(p.tanggal_pesan)
    ORDER BY p.id_konsumen ASC
";

$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesanan Hari Ini</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('uploads/background admin.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            font-family: 'Segoe UI', sans-serif;
        }

       

        h3 {
            color: #d63384;
            font-weight: bold;
        }

        .card-pesanan {
            background-color: #fff8f0;
            border-left: 6px solid #d63384;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.08);
        }

        .card-pesanan h5 {
            color: #333;
        }

        .badge-custom {
            background-color: #fcd34d;
            color: #000;
            font-size: 14px;
            margin-right: 5px;
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <div class="overlay">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>📋 Pesanan Hari Ini (<?= $today ?>)</h3>
                <a href="dashboard_admin.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
            </div>

            <?php 
            $no = 1;
            $ada_pesanan = false;
            while ($row = mysqli_fetch_assoc($result)): 
                $ada_pesanan = true;
            ?>
                <div class="card-pesanan">
                    <h5>👤 Konsumen #<?= $row['id_konsumen'] ?></h5>
                    <p><strong>📝 Pesanan:</strong> <?= $row['pesanan'] ?></p>
                    <p><span class="badge bg-info text-dark"><?= strtoupper($row['layanan']) ?></span>
                       <?php if ($row['layanan'] === 'dine-in'): ?>
                           <span class="badge bg-secondary">No Meja: <?= $row['no_meja'] ?></span>
                       <?php endif; ?>
                    </p>
                    <p>
                        <span class="badge-custom">Pengambilan: <?= $row['pengambilan'] ?></span>
                        <span class="badge-custom">Pembayaran: <?= $row['pembayaran'] ?></span>
                        <span class="badge bg-light text-dark border">Tanggal: <?= $row['tanggal'] ?></span>
                    </p>
                </div>
            <?php 
                $no++;
            endwhile;

            if (!$ada_pesanan): ?>
                <div class="alert alert-warning text-center">
                    Belum ada pesanan hari ini.
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
