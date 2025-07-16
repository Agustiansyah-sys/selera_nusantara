<?php
session_start();
if (!isset($_SESSION['struk'])) {
    header("Location: order.php");
    exit;
}
$struk = $_SESSION['struk'];

// Kata-kata manis tentang makanan Nusantara
$quotes = [
    "Terima kasih sudah mencicipi rasa Nusantara, semoga harimu selumer rendang!",
    "Hidup itu pedas-manis, seperti sambal dan serundeng favoritmu.",
    "Nikmati hidup selayaknya menyantap soto hangat di pagi hari.",
    "Semoga kenyangnya tahan lama, seperti kenangan makan gudeg di Jogja.",
    "Cita rasa Nusantara, untuk jiwa yang bahagia. Terima kasih sudah memesan!",
    "Lezatnya tak sekadar rasa, tapi juga cerita dari tiap suapan Nusantara.",
    "Semoga senyum Anda selezat es cendol di siang hari!",
];
$quote = $quotes[array_rand($quotes)];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pemesanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(rgba(255,255,255,0.92), rgba(255,255,255,0.95)), url('uploads/struk.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
        }
        .struk-box {
            background-color: rgba(255, 255, 255, 0.97);
            border-radius: 15px;
            padding: 30px;
            margin-top: 50px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        .quote {
            font-style: italic;
            color: #555;
            text-align: center;
            margin-top: 30px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="struk-box mx-auto col-md-8">
        <h4 class="text-center fw-bold mb-4">📋 Struk Pemesanan - Selera Nusantara</h4>
        
        <p><strong>Tanggal:</strong> <?= htmlspecialchars($struk['tanggal']) ?></p>
        <p><strong>Metode:</strong> <?= ucfirst(htmlspecialchars($struk['layanan'])) ?></p>

        <?php if ($struk['layanan'] == 'dine-in'): ?>
            <p><strong>Meja:</strong> <?= htmlspecialchars($struk['no_meja']) ?></p>
        <?php else: ?>
            <p><strong>Pengambilan:</strong> <?= ucfirst(htmlspecialchars($struk['pengambilan'])) ?></p>
        <?php endif; ?>

        <p><strong>Pembayaran:</strong> <?= ucfirst(htmlspecialchars($struk['pembayaran'])) ?></p>

        <table class="table table-bordered table-sm mt-3">
            <thead class="table-light">
                <tr>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($struk['items'] as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nama_menu']) ?></td>
                    <td>Rp <?= number_format($item['harga']) ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($item['subtotal']) ?></td>
                </tr>
                <?php endforeach; ?>

                <tr>
                    <th colspan="3" class="text-end">Total</th>
                    <td>Rp <?= number_format($struk['total']) ?></td>
                </tr>

                <?php if ($struk['diskon'] > 0): ?>
                <tr>
                    <th colspan="3" class="text-end">Diskon 10%</th>
                    <td>- Rp <?= number_format($struk['diskon']) ?></td>
                </tr>
                <?php endif; ?>

                <tr>
                    <th colspan="3" class="text-end">Total Bayar</th>
                    <td><strong>Rp <?= number_format($struk['total_bayar']) ?></strong></td>
                </tr>
            </tbody>
        </table>

        <div class="quote">
            “<?= $quote ?>”
        </div>
    </div>
</div>

<script>
    // Cetak otomatis saat halaman dibuka
    window.onload = function () {
        window.print();
    };
</script>
</body>
</html>
