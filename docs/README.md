# 🍽️ Selera Nusantara - Aplikasi Pemesanan Makanan Khas Indonesia

Selamat datang di repositori **Selera Nusantara**, sebuah aplikasi web dinamis yang memungkinkan pengunjung untuk melihat menu makanan khas Indonesia dan melakukan pemesanan secara daring. Website ini dibuat menggunakan **HTML, CSS, PHP Native, MySQL**, dan **Bootstrap**, dengan dua level pengguna: **Admin** dan **Konsumen**.

---

## 📌 Fitur Unggulan

### 🔐 Login
- **Admin**: Login dengan username & password.
- **Konsumen**: Login cukup dengan memasukkan nama.

### 👤 Admin
- Kelola **data user/admin**
- Kelola **kategori menu**
- Kelola **menu makanan & gambar**
- Lihat & hapus **data pesanan harian**
- **Laporan** rekap pemesanan harian
- Dashboard dengan tampilan menarik

### 👥 Konsumen
- Melihat **daftar menu berdasarkan kategori**
- Melakukan **pemesanan** dengan pilihan:
  - Metode: **Dine-in** / **Takeaway**
  - Pembayaran: **QRIS**, **Transfer**, **Tunai**
  - Ambil sendiri / Gunakan kurir (jika takeaway)
- Sistem **diskon otomatis** jika total belanja ≥ Rp50.000
- Mencetak **struk pemesanan otomatis**
- Dashboard dengan waktu real-time dan promo harian

---

## 🧱 Teknologi yang Digunakan

| Teknologi     | Keterangan                        |
|---------------|-----------------------------------|
| HTML/CSS      | Struktur & tampilan website       |
| PHP Native    | Logika backend & sesi pengguna    |
| MySQL         | Basis data relasional             |
| Bootstrap 5   | Desain responsif & komponen UI    |

---

## 🗃️ Struktur Folder

selera-nusantara/
├── index.php
├── login_admin.php
├── login_konsumen.php
├── dashboard_admin.php
├── dashboard_konsumen.php
├── kategori.php
├── menu.php
├── user.php
├── pesanan.php
├── laporan.php
├── order.php
├── proses_pemesanan.php
├── struk.php
├── hapus_pesanan.php
├── reset_admin.php
├── koneksi.php
├── logout.php
├── uploads/ ← Gambar latar dan menu
├── screenshot/ ← Gambar untuk README
├── sql/
│ └── selera_nusantara.sql
└── README.md

---

## 📸 Screenshot Antarmuka

### 🔐 Login Admin  
![Login Admin](screenshot/login_admin.png)

### 📊 Dashboard Admin  
![Dashboard Admin](screenshot/dashboard_admin.png)

### 🙋‍♂️ Login Konsumen  
![Login Konsumen](screenshot/login_konsumen.png)

### 🍽️ Daftar Menu  
![Menu](screenshot/menu.png)

### 📝 Form Pemesanan  
![Form Pemesanan](screenshot/pemesanan.png)

### 🧾 Struk Cetak Otomatis  
![Struk](screenshot/struk.png)

---

## ⚙️ Cara Install & Menjalankan Proyek

1. Clone repo ini atau download ZIP-nya.
2. Pastikan kamu sudah mengaktifkan **XAMPP / Laragon**, lalu:
   - Letakkan semua file di folder `htdocs/selera-nusantara/`
   - Jalankan `phpmyadmin`, buat database baru, dan **import `sql/selera_nusantara.sql`**
3. Buka browser:
   - Admin login: [http://localhost/selera-nusantara/login_admin.php](http://localhost/selera-nusantara/login_admin.php)
   - Konsumen: [http://localhost/selera-nusantara/login_konsumen.php](http://localhost/selera-nusantara/login_konsumen.php)

---

## 📽️ Video Demo

🔗 [Link YouTube Demo](https://youtu.be/xxxxxxxx) ← *Upload videomu di sini*

---

## 🧑‍🎓 Dibuat oleh:
**Mira Agustiansyah (202312033)**  
📚 Proyek UAS Mata Kuliah: Pemrograman Web  
🏫 STITEK Bontang
