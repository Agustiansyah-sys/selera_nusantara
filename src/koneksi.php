<?php
$koneksi = mysqli_connect("localhost", "root", "", "selera_nusantara", 3307);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
