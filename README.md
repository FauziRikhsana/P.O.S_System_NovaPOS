<div align="center">

# 🛒 NexaPOS
### Smart Point of Sale Management System

Sistem Point of Sale (POS) berbasis **Laravel 12** yang dirancang untuk membantu proses pengelolaan produk, supplier, transaksi penjualan, dan laporan dengan antarmuka modern.

![Laravel](https://img.shields.io/badge/Laravel-12-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-Database-orange?style=for-the-badge&logo=mysql)
![TailwindCSS](https://img.shields.io/badge/TailwindCSS-Modern_UI-38BDF8?style=for-the-badge&logo=tailwindcss)

</div>

---

# 📖 Tentang Project

**NexaPOS** adalah aplikasi Point of Sale (POS) yang dibuat sebagai proyek **Ujian Akhir Semester (UAS)**.

Aplikasi ini membantu proses:

- 📦 Manajemen Produk
- 🏷️ Manajemen Kategori
- 🚚 Manajemen Supplier
- 💰 Transaksi Penjualan
- 📊 Dashboard
- 📜 Riwayat Penjualan
- 👥 Multi Role (Admin & Kasir)

---

# ✨ Fitur

## 👨‍💼 Admin

- Dashboard
- CRUD Kategori
- CRUD Supplier
- CRUD Produk
- Upload Gambar Produk
- Generate QR Code Produk
- Manajemen Stok
- Riwayat Penjualan

---

## 🧑‍💻 Kasir

- Login
- Dashboard Kasir
- Transaksi Penjualan
- Keranjang Belanja
- Pembayaran Tunai
- Pembayaran QRIS *(Coming Soon)*
- Cetak Struk *(Coming Soon)*
- Riwayat Transaksi

---

# 🛠️ Tech Stack

| Technology | Version |
|------------|---------|
| Laravel | 12 |
| PHP | 8.2 |
| MySQL | Latest |
| Tailwind CSS | Latest |
| Blade | Template Engine |
| Vite | Build Tool |
| Composer | Dependency Manager |

---

# 📂 Struktur Project

```
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

### Clone Repository

```bash
git clone https://github.com/USERNAME/NexaPOS.git
```

Masuk ke folder project

```bash
cd NexaPOS
```

Install dependency

```bash
composer install
```

Install Node Modules

```bash
npm install
```

Copy file environment

```bash
cp .env.example .env
```

Generate Key

```bash
php artisan key:generate
```

Atur database pada file `.env`

```env
DB_DATABASE=nexapos
DB_USERNAME=root
DB_PASSWORD=
```

Migrasi database

```bash
php artisan migrate
```

Buat symbolic link

```bash
php artisan storage:link
```

Jalankan server Laravel

```bash
php artisan serve
```

Jalankan Vite

```bash
npm run dev
```

---

# 📸 Tampilan

### Login

> Modern Login Page

### Dashboard

> Dashboard Admin

### Produk

> CRUD Produk + QR Code

### Kasir

> Halaman Transaksi

---

# 🔐 Role User

| Role | Hak Akses |
|------|-----------|
| Admin | Mengelola seluruh sistem |
| Kasir | Melakukan transaksi penjualan |

---

# 📈 Roadmap

- [x] Login
- [x] Dashboard
- [x] CRUD Kategori
- [x] CRUD Supplier
- [x] CRUD Produk
- [x] Upload Gambar
- [x] QR Code Produk
- [x] Multi Role
- [x] Transaksi
- [ ] QRIS Payment
- [ ] Cetak Struk PDF
- [ ] Laporan Penjualan
- [ ] Grafik Dashboard

---

# 🤝 Kontribusi

Project ini dibuat sebagai media pembelajaran dan tugas **Ujian Akhir Semester (UAS)**.

Pull Request dan masukan selalu diterima.

---

# 👨‍💻 Developer

**NexaPOS**

Developed with ❤️ using Laravel 12

---

<div align="center">

### ⭐ Jika project ini bermanfaat, jangan lupa berikan Star ⭐

</div>
