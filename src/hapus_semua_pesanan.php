<?php
include 'koneksi.php';
mysqli_query($koneksi, "DELETE FROM pesanan");
header("Location: laporan.php");
exit;
