<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <strong>Sistem Cuti Pegawai</strong><br>
  <em>Aplikasi Laravel untuk mengelola pengajuan cuti dan data pegawai</em><br><br>
  <a href="https://github.com/ilyasdwisantoso/cuti-pegawai/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://opensource.org/licenses/MIT"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

---

## 📌 Tentang Proyek

**Sistem Cuti Pegawai** adalah aplikasi Laravel berbasis web untuk mengelola:

-   Data pegawai
-   Pengajuan cuti online
-   Proses persetujuan cuti oleh admin
-   Laporan cuti berdasarkan tahun berjalan

---

## ✨ Fitur Utama

-   🔐 Login dan Register (hanya untuk pegawai)
-   📊 Dashboard Admin dan Pegawai terpisah
-   👨‍💼 Admin:
    -   CRUD Data Pegawai dan Admin
    -   Persetujuan atau penolakan cuti
    -   Laporan cuti tahunan
-   🧍‍♂️ Pegawai:
    -   Ajukan cuti dengan validasi ketat
    -   Melihat status cuti pribadi
-   ✅ Validasi Cuti:
    -   Maksimal 12 hari per tahun
    -   Maksimal 1 hari per bulan

---

## 🚀 Instalasi Proyek

### 1. Clone Repository

```bash
git clone https://github.com/ilyasdwisantoso/cuti-pegawai.git
cd cuti-pegawai
```

### 2. Install Dependency

```bash
composer install
```

### 3. Setup File `.env`

```bash
cp .env.example .env
php artisan key:generate
```

Edit konfigurasi database di file `.env`:

```env
DB_DATABASE=cuti_pegawai
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi Database

```bash
php artisan migrate
```

### 5. Jalankan Server Lokal

```bash
php artisan serve
```

Akses melalui:  
➡️ http://127.0.0.1:8000

---

## 👥 Akun Uji Coba

| Role  | Email          | Password |
| ----- | -------------- | -------- |
| Admin | admin@cuti.com | admin123 |

Silakan daftar akun sebagai pegawai melalui halaman **Register** di aplikasi.

## ⚙️ Teknologi Digunakan

-   Laravel 10
-   Bootstrap 5
-   Font Awesome 6
-   jQuery + DataTables
-   Middleware `isAdmin`, `isPegawai`

---

## 🧪 Validasi Cuti

-   ❌ Tidak bisa cuti lebih dari 12 hari dalam setahun
-   ❌ Tidak bisa cuti lebih dari 1 hari di bulan yang sama
-   ✅ Validasi dilakukan saat pengajuan di `CutiController`

---

## 📊 Laporan

-   Admin dapat melihat total hari cuti yang diambil setiap pegawai per tahun di halaman `admin/cuti/laporan`

---

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

---

## 🤝 Kontribusi

Silakan fork, pull request, atau ajukan issue melalui:
👉 https://github.com/ilyasdwisantoso/cuti-pegawai

---

## 👨‍💻 Author

Made with ❤️ by [@ilyasdwisantoso](https://github.com/ilyasdwisantoso)
