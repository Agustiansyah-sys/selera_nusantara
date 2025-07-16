<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login_admin.php");
    exit;
}

include 'koneksi.php';

// Tambah menu
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $id_kategori = $_POST['id_kategori'];

    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    move_uploaded_file($tmp, "uploads/" . $gambar);

    mysqli_query($koneksi, "INSERT INTO menu (nama_menu, harga, deskripsi, id_kategori, gambar) 
        VALUES ('$nama', '$harga', '$deskripsi', '$id_kategori', '$gambar')");
    header("Location: menu.php");
    exit;
}

// Hapus menu
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $get = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT gambar FROM menu WHERE id_menu='$id'"));
    if ($get && file_exists("uploads/" . $get['gambar'])) {
        unlink("uploads/" . $get['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM menu WHERE id_menu='$id'");
    header("Location: menu.php");
    exit;
}

$kategori = mysqli_query($koneksi, "SELECT * FROM kategori_menu");
$filter = isset($_GET['kategori']) ? $_GET['kategori'] : '';
if ($filter != '') {
    $menu = mysqli_query($koneksi, "SELECT menu.*, kategori_menu.nama_kategori FROM menu 
        JOIN kategori_menu ON menu.id_kategori = kategori_menu.id_kategori 
        WHERE menu.id_kategori = '$filter' ORDER BY id_menu DESC");
} else {
    $menu = mysqli_query($koneksi, "SELECT menu.*, kategori_menu.nama_kategori FROM menu 
        JOIN kategori_menu ON menu.id_kategori = kategori_menu.id_kategori 
        ORDER BY id_menu DESC");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #fffaf0;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-custom {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .img-thumb {
            width: 70px;
            border-radius: 10px;
            object-fit: cover;
        }
        h3 {
            color: #ff6f61;
            font-weight: bold;
        }
    </style>
</head>
<body class="p-4">
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>🍛 Daftar Menu</h3>
        <a href="dashboard_admin.php" class="btn btn-outline-secondary">← Kembali ke Dashboard</a>
    </div>

    <!-- Form Tambah -->
    <div class="card-custom mb-4">
        <form method="post" enctype="multipart/form-data" class="row g-2">
            <div class="col-md-2"><input type="text" name="nama" class="form-control" placeholder="Nama Menu" required></div>
            <div class="col-md-2"><input type="number" name="harga" class="form-control" placeholder="Harga" required></div>
            <div class="col-md-2"><input type="text" name="deskripsi" class="form-control" placeholder="Deskripsi" required></div>
            <div class="col-md-2">
                <select name="id_kategori" class="form-select" required>
                    <option value="">-- Pilih Kategori --</option>
                    <?php foreach ($kategori as $kat): ?>
                        <option value="<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="file" name="gambar" class="form-control" accept="image/*" required>
            </div>
            <div class="col-md-2"><button name="tambah" class="btn btn-warning w-100">+ Tambah</button></div>
        </form>
    </div>

    <!-- Filter -->
    <form method="get" class="mb-3 d-flex align-items-center gap-2">
        <label class="fw-bold">Filter Kategori:</label>
        <select name="kategori" class="form-select w-auto" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <?php mysqli_data_seek($kategori, 0); foreach ($kategori as $kat): ?>
                <option value="<?= $kat['id_kategori'] ?>" <?= ($filter == $kat['id_kategori']) ? 'selected' : '' ?>>
                    <?= $kat['nama_kategori'] ?>
                </option>
            <?php endforeach ?>
        </select>
        <?php if ($filter): ?>
            <a href="menu.php" class="btn btn-sm btn-outline-secondary">Reset</a>
        <?php endif ?>
    </form>

    <!-- Tabel Menu Berdasarkan Kategori -->
    <?php
    $grouped_menu = [];
    foreach ($menu as $m) {
        $grouped_menu[$m['nama_kategori']][] = $m;
    }

    foreach ($grouped_menu as $kategori => $daftar):
    ?>
        <h5 class="mt-4 mb-2">Kategori: <span class="text-primary"><?= $kategori ?></span></h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>No</th><th>Gambar</th><th>Nama Menu</th><th>Harga</th><th>Deskripsi</th><th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach ($daftar as $m): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><img src="uploads/<?= $m['gambar'] ?>" class="img-thumb"></td>
                        <td><?= $m['nama_menu'] ?></td>
                        <td><span class="badge bg-success">Rp<?= number_format($m['harga']) ?></span></td>
                        <td><?= $m['deskripsi'] ?></td>
                        <td>
                            <a href="?hapus=<?= $m['id_menu'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus menu ini?')">🗑 Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

</div>
</body>
</html>
