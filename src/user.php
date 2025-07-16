<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit;
}
include 'koneksi.php';

// Tambah User
if (isset($_POST['tambah'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];
    mysqli_query($koneksi, "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')");
    header("Location: user.php");
    exit;
}

// Hapus User
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");
    header("Location: user.php");
    exit;
}

// Ambil semua user
$users = mysqli_query($koneksi, "SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Pengguna</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background: url('uploads/background admin.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            color: white;
        }
       
        .table {
            background: white;
            color: black;
        }
        .form-control, .form-select {
            border-radius: 10px;
        }
        .btn-primary, .btn-danger, .btn-secondary {
            border-radius: 10px;
            font-weight: 500;
        }
        h3 {
            color: #ffc107;
            font-weight: bold;
            text-shadow: 1px 1px 3px black;
        }
    </style>
</head>
<body>
<div class="overlay container">
    <h3 class="text-center mb-4">👥 Manajemen Pengguna</h3>

    <!-- Form Tambah -->
    <form method="post" class="row g-3 mb-4">
        <div class="col-md-3">
            <input type="text" name="username" class="form-control" placeholder="Username" required>
        </div>
        <div class="col-md-3">
            <input type="text" name="password" class="form-control" placeholder="Password" required>
        </div>
        <div class="col-md-3">
            <select name="role" class="form-select" required>
                <option value="">-- Pilih Role --</option>
                <option value="admin">Admin</option>
                <option value="kasir">Kasir</option>
            </select>
        </div>
        <div class="col-md-3">
            <button name="tambah" class="btn btn-primary w-100">+ Tambah</button>
        </div>
    </form>

    <!-- Tabel User -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped shadow">
            <thead class="table-dark">
                <tr>
                    <th>No</th><th>Username</th><th>Role</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($users as $row): ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= ucfirst($row['role']) ?></td>
                    <td>
                        <a href="?hapus=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus user ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>

    <!-- Tombol Kembali -->
    <a href="dashboard_admin.php" class="btn btn-secondary mt-3">← Kembali ke Dashboard</a>
</div>
</body>
</html>
