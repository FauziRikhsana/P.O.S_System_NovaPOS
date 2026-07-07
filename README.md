<div align="center">

# 🛒 NexaPOS

### Smart Point of Sale Management System

Sistem Point of Sale (POS) berbasis **Laravel 12** yang membantu pengelolaan produk, supplier, transaksi penjualan, serta laporan dalam satu aplikasi dengan antarmuka modern.

![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.2-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Database-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/TailwindCSS-Modern_UI-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)
![License](https://img.shields.io/badge/License-Educational-success?style=for-the-badge)

</div>

---

# 👨‍🎓 Identitas Mahasiswa

| Keterangan | Informasi |
|------------|-----------|
| **Nama** | **Fauzi Rikhshana** |
| **NIM** | **23552011030** |
| **Program Studi** | Teknik Informatika |
| **Mata Kuliah** | Pemrograman Web 2 |
| **Universitas** | Universitas Teknologi Bandung |

---

# 📖 Tentang Project

**NexaPOS** merupakan aplikasi **Point of Sale (POS)** berbasis web yang dikembangkan menggunakan **Laravel 12**.

Aplikasi ini dibuat sebagai proyek **Ujian Akhir Semester (UAS)** untuk membantu proses pengelolaan toko mulai dari data produk, supplier, transaksi penjualan hingga riwayat transaksi dengan sistem yang modern dan mudah digunakan.

---

# ✨ Fitur

## 👨‍💼 Admin

- 📊 Dashboard
- 📦 CRUD Produk
- 🏷 CRUD Kategori
- 🚚 CRUD Supplier
- 🖼 Upload Gambar Produk
- 🔳 Generate QR Code Produk
- 📈 Manajemen Stok
- 📜 Riwayat Penjualan

---

## 🧑‍💻 Kasir

- 🔐 Login
- 📊 Dashboard Kasir
- 🛒 Transaksi Penjualan
- ➕ Keranjang Belanja
- 💵 Payment
- 📜 Riwayat Transaksi

---

# 🛠 Tech Stack

| Teknologi | Digunakan |
|------------|-----------|
| Laravel | 12 |
| PHP | 8.2 |
| MySQL | Database |
| Tailwind CSS | User Interface |
| Blade | Template Engine |
| Vite | Asset Bundler |
| Composer | Dependency Manager |
| Git | Version Control |

---
## Clone Repository

```bash
git clone https://github.com/FauziRikhsana/P.O.S_System_NovaPOS
```

## 1 Masuk ke Folder

```bash
cd NexaPOS
```

## 2 Install Dependency Laravel

```bash
composer install
```

## 3 Install Dependency Frontend

```bash
npm install
```

## 4. Copy File Environment

```bash
cp .env.example .env
```

## 5 Generate Application Key

```bash
php artisan key:generate
```

## 6 Konfigurasi Database

Buka file **.env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nexapos
DB_USERNAME=root
DB_PASSWORD=
```

## 7 Jalankan Migrasi

```bash
php artisan migrate
```

## 8 Buat Storage Link

```bash
php artisan storage:link
```

## 9 Jalankan Server

```bash
php artisan serve
```

## 10. Jalankan Vite

```bash
npm run dev
```

# 🔐 Role Pengguna

| Role | Hak Akses |
|------|-----------|
| 👨‍💼 Admin | Mengelola seluruh sistem |
| 🧑‍💻 Kasir | Melakukan transaksi penjualan |
---

# Akun Login
|email | password |
|------|-----------|
|admin@pos.com|password|
|kasir@pos.com|kasirPOS|
---

# 📈 Roadmap

- ✅ Login
- ✅ Dashboard Admin
- ✅ Dashboard Kasir
- ✅ CRUD Kategori
- ✅ CRUD Supplier
- ✅ CRUD Produk
- ✅ Upload Gambar Produk
- ✅ Generate QR Code Produk
- ✅ Multi Role
- ✅ Transaksi Penjualan
- ✅ Riwayat Penjualan
- ⏳ Pembayaran QRIS
- ⏳ Cetak Struk PDF
- ⏳ Grafik Dashboard
- ⏳ Laporan Penjualan

---

# 📄 Lisensi

Project ini dibuat untuk keperluan **Ujian Akhir Semester (UAS)** dan sebagai media pembelajaran.

---

# 👨‍💻 Developer

**Nama :** Fauzi Rikhshana

**NIM :** 23552011030

**Program Studi :** Teknik Informatika

**Universitas :** Universitas Teknologi Bandung

---

<div align="center">

## ⭐ Terima kasih telah mengunjungi repository ini ⭐

**NexaPOS — Smart Point of Sale Management System**

Made with using **Laravel 12**

</div>
