<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    mysqli_query($koneksi, "DELETE FROM pesanan WHERE id_pesanan = '$id'");
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
