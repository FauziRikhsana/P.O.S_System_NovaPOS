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
| **Nama** | **Nama Lengkap Kamu** |
| **NIM** | **NIM Kamu** |
| **Program Studi** | Teknik Informatika |
| **Mata Kuliah** | Pemrograman Web |
| **Universitas** | Nama Universitas Kamu |

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
- 💵 Pembayaran Tunai
- 📱 Pembayaran QRIS *(Coming Soon)*
- 🧾 Cetak Struk *(Coming Soon)*
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

# 📂 Struktur Project

```text
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
vendor/
```

---

# 🚀 Instalasi

## 1. Clone Repository

```bash
git clone https://github.com/USERNAME/NexaPOS.git
```

## 2. Masuk ke Folder

```bash
cd NexaPOS
```

## 3. Install Dependency Laravel

```bash
composer install
```

## 4. Install Dependency Frontend

```bash
npm install
```

## 5. Copy File Environment

```bash
cp .env.example .env
```

## 6. Generate Application Key

```bash
php artisan key:generate
```

## 7. Konfigurasi Database

Buka file **.env**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nexapos
DB_USERNAME=root
DB_PASSWORD=
```

## 8. Jalankan Migrasi

```bash
php artisan migrate
```

## 9. Buat Storage Link

```bash
php artisan storage:link
```

## 10. Jalankan Server

```bash
php artisan serve
```

## 11. Jalankan Vite

```bash
npm run dev
```

---

# 📸 Tampilan Aplikasi

### 🔐 Login

> Modern Login Page

---

### 📊 Dashboard Admin

> Menampilkan ringkasan data sistem.

---

### 📦 Manajemen Produk

> CRUD Produk beserta QR Code.

---

### 🛒 Halaman Kasir

> Transaksi penjualan dengan sistem keranjang.

---

# 🔐 Role Pengguna

| Role | Hak Akses |
|------|-----------|
| 👨‍💼 Admin | Mengelola seluruh sistem |
| 🧑‍💻 Kasir | Melakukan transaksi penjualan |

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

**Nama :** Nama Lengkap Kamu

**NIM :** NIM Kamu

**Program Studi :** Teknik Informatika

**Universitas :** Nama Universitas Kamu

---

<div align="center">

## ⭐ Terima kasih telah mengunjungi repository ini ⭐

**NexaPOS — Smart Point of Sale Management System**

Made with ❤️ using **Laravel 12**

</div>
