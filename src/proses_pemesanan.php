<?php
session_start();
include 'koneksi.php';

// Cek login & role konsumen
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'konsumen') {
    header("Location: login_konsumen.php");
    exit;
}

// Ambil data dari form
$id_konsumen   = $_SESSION['id_konsumen'];
$id_menu       = $_POST['id_menu'];
$jumlah        = $_POST['jumlah'];
$layanan       = $_POST['metode']; // 'dine-in' atau 'takeaway'
$no_meja       = $_POST['nomor_meja'] ?? '';
$pengambilan   = $_POST['pengambilan'] ?? '';
$pembayaran    = $_POST['pembayaran'];

$items = [];
$total = 0;

// Hitung total pesanan dan simpan data menu
for ($i = 0; $i < count($id_menu); $i++) {
    $id = $id_menu[$i];
    $qty = $jumlah[$i];

    $menu = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM menu WHERE id_menu = '$id'"));
    $harga = $menu['harga'];
    $nama_menu = $menu['nama_menu'];
    $subtotal = $harga * $qty;
    $total += $subtotal;

    $items[] = [
        'id_menu'   => $id,
        'nama_menu'=> $nama_menu,
        'harga'    => $harga,
        'jumlah'   => $qty,
        'subtotal' => $subtotal
    ];
}

// Hitung diskon 10% jika total > 50000
$diskon = ($total > 50000) ? $total * 0.10 : 0;
$total_bayar = $total - $diskon;

// Simpan ke tabel pesanan
foreach ($items as $item) {
    mysqli_query($koneksi, "INSERT INTO pesanan 
    (id_konsumen, id_menu, jumlah, layanan, no_meja, pengambilan, pembayaran, tanggal_pesan) 
    VALUES (
        '$id_konsumen',
        '{$item['id_menu']}',
        '{$item['jumlah']}',
        '$layanan',
        '$no_meja',
        '$pengambilan',
        '$pembayaran',
        NOW()
    )");
}

// Simpan info struk ke session
$_SESSION['struk'] = [
    'items'        => $items,
    'total'        => $total,
    'diskon'       => $diskon,
    'total_bayar'  => $total_bayar,
    'layanan'      => $layanan,
    'no_meja'      => $no_meja,
    'pengambilan'  => $pengambilan,
    'pembayaran'   => $pembayaran,
    'tanggal'      => date('Y-m-d H:i:s')
];

// Arahkan ke halaman struk
header("Location: struk.php");
exit;
?>
