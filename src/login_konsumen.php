<?php
session_start();
include 'koneksi.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama']);

    if ($nama != "") {
        $q = mysqli_query($koneksi, "SELECT * FROM konsumen WHERE LOWER(nama) = LOWER('$nama')");
        if (mysqli_num_rows($q) == 1) {
            $konsumen = mysqli_fetch_assoc($q);
        } else {
            mysqli_query($koneksi, "INSERT INTO konsumen (nama) VALUES ('$nama')");
            $id_baru = mysqli_insert_id($koneksi);
            $konsumen = ['id' => $id_baru, 'nama' => $nama];
        }

        $_SESSION['username'] = $konsumen['nama'];
        $_SESSION['id_konsumen'] = $konsumen['id'];
        $_SESSION['role'] = 'konsumen';

        header("Location: dashboard_konsumen.php");
        exit;
    } else {
        $error = "Nama tidak boleh kosong.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Masuk - Selera Nusantara</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('uploads/login konsumen.jpg');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
      font-family: 'Segoe UI', sans-serif;
      color: #fff;
    }

    .overlay {
      background-color: rgba(0, 0, 0, 0.4);
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      text-align: center;
      padding: 30px;
    }

    h2 {
      font-size: 2rem;
      font-weight: bold;
      margin-bottom: 25px;
      color: #fff;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.5);
    }

    input[type="text"] {
      max-width: 400px;
      width: 90%;
      margin: auto;
      padding: 15px 20px;
      font-size: 1.1rem;
      border-radius: 30px;
      border: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
    }

    button {
      margin-top: 15px;
      padding: 12px 30px;
      font-size: 1rem;
      border: none;
      border-radius: 30px;
      background-color: #d63384;
      color: #fff;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      transition: 0.3s ease;
    }

    button:hover {
      background-color: #c2216b;
    }

    .alert {
      max-width: 400px;
      margin: 10px auto;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <h2>🍽 Selamat Datang di Selera Nusantara</h2>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <form method="post">
      <input type="text" name="nama" placeholder="Masukkan nama Anda..." required>
      <br>
      <button type="submit">Masuk Sekarang</button>
    </form>
  </div>
</body>
</html>
