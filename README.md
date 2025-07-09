<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
    </a>
</p>

<p align="center">
    <a href="https://github.com/laravel/framework/actions">
        <img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://img.shields.io/packagist/l/laravel/framework" alt="License">
    </a>
</p>

---

# 🚗 Aplikasi Pemesanan Kendaraan

Aplikasi Laravel untuk mengelola proses pemesanan kendaraan dengan sistem persetujuan bertingkat, dashboard grafik, serta ekspor laporan pemesanan.

---

## 👤 Akun Login

| Role        | Email                  | Password   |
|-------------|------------------------|------------|
| Admin       | admin@example.com      | password   |
| Approver 1  | approver1@example.com  | password   |
| Approver 2  | approver2@example.com  | password   |

---

## ⚙️ Teknologi yang Digunakan

- **PHP**: 8.2  
- **Node.js**: 20.10.0  
- **Framework**: Laravel 12  
- **Database**: MySQL
- **Frontend**: Tailwind CSS 
- **Auth**: Laravel Breeze  
- **Role Management**: Spatie Laravel Permission  
- **Excel Export**: Maatwebsite Excel

---

## 📦 Instalasi

### 1. Clone dan Masuk Folder

git clone https://github.com/namapengguna/nama-repo.git  
cd nama-repo  

---

### 2. Install Dependency

composer install  
npm install  

---

### 3. Salin File .env

cp .env.example .env  
php artisan key:generate  

---

### 4. Edit .env dan atur koneksi database:

DB_DATABASE=your_db  
DB_USERNAME=root  
DB_PASSWORD=  

---

### 5. Jalankan Migrasi dan Seeder

php artisan migrate --seed  

---

### 6. Jalankan Server

npm run dev  
php artisan serve  
Buka di browser: http://localhost:8000  

---

## 📄 Dokumentasi Tambahan

- **Activity Diagram**: [`activity-diagram.png`](./activity-diagram.png)  
  Menjelaskan alur proses pemesanan kendaraan mulai dari login, input, hingga persetujuan oleh approver.

- **Physical Data Model (PDM)**: [`pdm.png`](./pdm.png)  
  Menampilkan relasi tabel dalam sistem pemesanan kendaraan, seperti `users`, `vehicles`, `reservations`, dan `approval_logs`.

Semua file dokumentasi tersebut disimpan di direktori utama (root) dari repository ini.