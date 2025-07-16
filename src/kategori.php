<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit;
}
include 'koneksi.php';

// Tambah kategori
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    mysqli_query($koneksi, "INSERT INTO kategori_menu (nama_kategori) VALUES ('$nama')");
    header("Location: kategori.php");
    exit;
}

// Hapus kategori
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM kategori_menu WHERE id_kategori='$id'");
    header("Location: kategori.php");
    exit;
}

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori_menu ORDER BY id_kategori DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kategori Menu</title>
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
            background: rgba(255, 255, 255, 0.92);
            border-radius: 16px;
            padding: 30px;
            margin-top: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        h3 {
            color: #d63384;
            font-weight: bold;
        }

        .btn-success {
            background-color: #20c997;
            border: none;
        }

        .btn-danger {
            background-color: #e74c3c;
            border: none;
        }

        .kategori-list {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .kategori-item {
            display: flex;
            align-items: center;
            background-color: #fff3cd;
            padding: 10px 18px;
            border-radius: 30px;
            font-size: 16px;
            color: #856404;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }

        .kategori-item .hapus-btn {
            margin-left: 10px;
            font-size: 14px;
            color: #dc3545;
            text-decoration: none;
        }

        .kategori-item .hapus-btn:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <div class="overlay mb-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>📂 Kategori Menu</h3>
                <a href="dashboard_admin.php" class="btn btn-outline-light bg-dark">← Kembali ke Dashboard</a>
            </div>

            <!-- Form Tambah Kategori -->
            <form method="post" class="row g-2 mb-4">
                <div class="col-md-10">
                    <input type="text" name="nama" class="form-control" placeholder="Masukkan nama kategori..." required>
                </div>
                <div class="col-md-2">
                    <button name="tambah" class="btn btn-success w-100">+ Tambah</button>
                </div>
            </form>

            <!-- Daftar Kategori -->
            <div class="kategori-list">
                <?php foreach ($kategori as $row): ?>
                    <div class="kategori-item">
                        <?= htmlspecialchars($row['nama_kategori']) ?>
                        <a href="?hapus=<?= $row['id_kategori'] ?>" class="hapus-btn" onclick="return confirm('Hapus kategori ini?')">🗑</a>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>
</html>
