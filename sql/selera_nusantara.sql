-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Waktu pembuatan: 13 Jul 2025 pada 05.34
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `selera_nusantara`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pesanan`
--

CREATE TABLE `detail_pesanan` (
  `id_detail` int(50) NOT NULL,
  `id_pesanan` int(100) NOT NULL,
  `id_menu` int(100) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `detail_pesanan`
--

INSERT INTO `detail_pesanan` (`id_detail`, `id_pesanan`, `id_menu`, `jumlah`) VALUES
(1, 1, 21, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `event`
--

CREATE TABLE `event` (
  `id_event` int(50) NOT NULL,
  `nama_event` varchar(100) NOT NULL,
  `deskrisi` text NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_selesai` date NOT NULL,
  `gambar_event` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `galeri`
--

CREATE TABLE `galeri` (
  `id_galeri` int(50) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanggal_upload` date NOT NULL,
  `tanggal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `id_kategori`
--

CREATE TABLE `id_kategori` (
  `id` int(50) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL COMMENT 'nama_kategori'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori_menu`
--

CREATE TABLE `kategori_menu` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `kategori_menu`
--

INSERT INTO `kategori_menu` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Makanan Berat'),
(2, 'Minuman'),
(3, 'Cemilan'),
(4, 'Dessert');

-- --------------------------------------------------------

--
-- Struktur dari tabel `konsumen`
--

CREATE TABLE `konsumen` (
  `id_konsumen` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `konsumen`
--

INSERT INTO `konsumen` (`id_konsumen`, `nama`) VALUES
(1, 'Mira'),
(2, 'Mira Agustiansyah'),
(3, 'Ayu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_aktivitas`
--

CREATE TABLE `log_aktivitas` (
  `id_login` int(50) NOT NULL,
  `id_logout` int(100) NOT NULL,
  `id_user` int(11) NOT NULL,
  `aksi` varchar(100) NOT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `menu`
--

CREATE TABLE `menu` (
  `id_menu` int(59) NOT NULL,
  `nama_menu` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `gambar` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `menu`
--

INSERT INTO `menu` (`id_menu`, `nama_menu`, `harga`, `deskripsi`, `id_kategori`, `gambar`) VALUES
(2, 'Rendang', 35000, 'daging sapi dimasak lama dengan santan dan rempah khas Minang, bercita rasa gurih dan pedas', 1, 'Rendang.jpg'),
(3, 'Gudeg', 30000, 'nangka muda manis, disajikan dengan telur dan ayam', 1, 'Gudeg.jpg'),
(4, 'ayam betutu', 50000, 'ayam utuh dengan rempah bali, kukus/panggang', 1, 'ayam betutu.jpg'),
(5, 'sate ayam madura', 25000, 'tusukan ayam bakar dengan saus kacang', 1, 'sate ayam madura.jpg'),
(6, 'Nasi Liwet Solo', 18000, 'nasi gurih+ayam suwir+ areh santan', 1, 'Nasi Liwet Solo.jpg'),
(7, 'Es Cendol', 10000, 'cendol hijau, santan, dan gula merah', 2, 'Es Cendol.jpg'),
(8, 'Wedang Jahe', 10000, 'minuman jahe hangat, plus serai', 2, 'Wedang Jahe.jpg'),
(9, 'Es Teler', 15000, 'buah campur + susu dan es serut', 2, 'Es Teler.jpg'),
(10, 'Bir Pletok', 15000, 'minuman herbal rempah khas betawi', 2, 'Bir Pletok.jpg'),
(11, 'Es Timun Suri', 15000, 'minuman segar dari buah timun suri', 2, 'Es Timun Suri.jpg'),
(12, 'Pisang Sale', 10000, 'pisang kering manis', 3, 'Pisang Sale.jpg'),
(13, 'Kacang Disco', 15000, 'kacang goreng balut tepung', 3, 'Kacang Disco.jpg'),
(14, 'Rengginang', 8000, 'kerupuk dari ketan goreng', 3, 'Rengginang.jpg'),
(15, 'Getuk', 9000, 'singkong tumbuk  manis dan berwarna-warni', 3, 'Getuk.jpg'),
(16, 'Emping Melinjo', 15000, 'keripik pahit khas melinjo', 3, 'Emping Melinjo.jpg'),
(17, 'Kue Lupis', 16000, 'ketan kukus+gula merah cair', 4, 'Kue Lupis.jpg'),
(18, 'Klepon', 15000, 'bola ketan isi gula merah', 4, 'Klepon.jpg'),
(19, 'Kue Lumpur', 17000, 'kue kentang lembut dan manis', 4, 'Kue Lumpur.jpg'),
(20, 'Es Pisang Ijo', 19000, 'pisang berbalut adonan hijjau dengan sirup', 4, 'Es Pisang Ijo.jpg'),
(21, 'Kue Talam', 7000, 'kue dua lapis (santan dan pandan)', 4, 'Kue Talam.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengaturan_web`
--

CREATE TABLE `pengaturan_web` (
  `id` int(50) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_whatsapp` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jam_buka` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_konsumen` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `layanan` varchar(20) NOT NULL,
  `no_meja` varchar(10) NOT NULL,
  `pengambilan` varchar(20) NOT NULL,
  `pembayaran` varchar(20) NOT NULL,
  `tanggal_pesan` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_konsumen`, `id_menu`, `jumlah`, `layanan`, `no_meja`, `pengambilan`, `pembayaran`, `tanggal_pesan`) VALUES
(13, 0, 3, 1, 'dine-in', 'A3', '', 'qris', '2025-07-11 09:06:02'),
(14, 0, 4, 1, 'dine-in', 'A3', '', 'qris', '2025-07-11 09:06:02'),
(15, 3, 5, 1, 'dine-in', '17', '', 'qris', '2025-07-12 10:48:35'),
(16, 3, 4, 1, 'dine-in', '17', '', 'qris', '2025-07-12 10:48:35'),
(17, 0, 9, 1, 'dine-in', 'D3', '', 'tunai', '2025-07-12 16:10:46'),
(18, 0, 3, 1, 'dine-in', 'D3', '', 'tunai', '2025-07-12 16:10:46'),
(19, 0, 13, 1, 'dine-in', 'D3', '', 'tunai', '2025-07-12 16:10:46'),
(20, 0, 4, 1, 'dine-in', '10B', '', 'qris', '2025-07-13 11:08:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasan`
--

CREATE TABLE `ulasan` (
  `id_ulasan` int(50) NOT NULL,
  `id_menu` int(100) NOT NULL,
  `nama_pengulas` varchar(100) NOT NULL,
  `komentar` text NOT NULL,
  `rating` int(11) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` enum('admin','kasir','','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@web.id', 'admin123', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indeks untuk tabel `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id_event`);

--
-- Indeks untuk tabel `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id_galeri`);

--
-- Indeks untuk tabel `id_kategori`
--
ALTER TABLE `id_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori_menu`
--
ALTER TABLE `kategori_menu`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  ADD PRIMARY KEY (`id_konsumen`);

--
-- Indeks untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indeks untuk tabel `pengaturan_web`
--
ALTER TABLE `pengaturan_web`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indeks untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  ADD PRIMARY KEY (`id_ulasan`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pesanan`
--
ALTER TABLE `detail_pesanan`
  MODIFY `id_detail` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `event`
--
ALTER TABLE `event`
  MODIFY `id_event` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id_galeri` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `id_kategori`
--
ALTER TABLE `id_kategori`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `kategori_menu`
--
ALTER TABLE `kategori_menu`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `konsumen`
--
ALTER TABLE `konsumen`
  MODIFY `id_konsumen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `log_aktivitas`
--
ALTER TABLE `log_aktivitas`
  MODIFY `id_login` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `menu`
--
ALTER TABLE `menu`
  MODIFY `id_menu` int(59) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `pengaturan_web`
--
ALTER TABLE `pengaturan_web`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `ulasan`
--
ALTER TABLE `ulasan`
  MODIFY `id_ulasan` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
