# 🏥 Sistem Informasi Reservasi Layanan Kesehatan dan Pemesanan Obat  
### Apotik dan Klinik Anggrek | Metode ICONIX Process

<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="#"><img src="https://img.shields.io/badge/Laravel-11.x-red" alt="Laravel Version"></a>
  <a href="#"><img src="https://img.shields.io/badge/License-MIT-blue" alt="License"></a>
  <a href="#"><img src="https://img.shields.io/badge/Framework-Spatie%20%7C%20Breeze-orange" alt="Frameworks"></a>
</p>

---

## 📘 Deskripsi Proyek

Proyek ini merupakan bagian dari **Skripsi** yang berjudul  
**“Rancang Bangun Sistem Informasi Untuk Reservasi Layanan Kesehatan dan Pemesanan Obat Berbasis Web di Apotik dan Klinik Anggrek Menggunakan Metode ICONIX Process.”**

Aplikasi ini bertujuan untuk mempermudah **proses reservasi layanan kesehatan (dokter umum & dokter gigi)** serta **pemesanan obat** di Apotik dan Klinik Anggrek yang sebelumnya masih dilakukan secara manual.  
Dikembangkan menggunakan **Laravel 11**, dengan tambahan paket **Spatie Laravel Permission** untuk manajemen hak akses dan **Laravel Breeze** untuk sistem autentikasi.

---

## ⚙️ Fitur Utama

### 🔐 Autentikasi dan Otorisasi
- Login, register, dan manajemen profil (Breeze)
- Role-based access (Spatie Permission)

### 👩‍⚕️ Fitur Customer
- Melakukan **reservasi layanan kesehatan**
- Melakukan **pembelian obat** secara online
- Melihat **riwayat transaksi & reservasi**
- Mengelola profil akun pribadi

### 🧾 Fitur Admin / Owner
- Mengelola **kategori obat**
- Mengelola **data produk obat**
- Mengelola **data reservasi pasien**
- Mengelola **transaksi pembelian obat**
- Melihat **rekap laporan reservasi & transaksi**

---

## 🗂️ Struktur Folder Penting

### Views (`resources/views`)
```
resources/views/
├── dashboard.blade.php
├── welcome.blade.php
├── layouts/
│   ├── app.blade.php
│   ├── guest.blade.php
│   └── navigation.blade.php
├── admin/
│   ├── categories/
│   ├── products/
│   ├── product_transactions/
│   └── reservation_page/
├── customers/
│   ├── dashboard_page/
│   ├── product_transactions/
│   └── reservation_page/
└── profile/
```

### Migration (`database/migrations`)
Beberapa tabel penting:
```
create_users_table.php
create_categories_table.php
create_products_table.php
create_carts_table.php
create_product_transactions_table.php
create_transaction_details_table.php
create_reservations_table.php
create_rekaps_table.php
```

### Model (`app/Models`)
```
Cart.php
Category.php
Product.php
ProductTransaction.php
Reservation.php
TransactionDetail.php
Rekap.php
User.php
```

### Controller (`app/Http/Controllers`)
```
CartController.php
CategoryController.php
Controller.php
DashboardPageController.php
ProductController.php
ProductTransactionController.php
ProfileController.php
ReservationController.php
UserDashboardController.php
UserProductTransactionController.php
```

---

## 🧩 Teknologi yang Digunakan

| Komponen | Teknologi |
|-----------|------------|
| Framework | Laravel 11 |
| Authentication | Laravel Breeze |
| Authorization | Spatie Laravel Permission |
| Database | MySQL |
| Frontend | Blade + Tailwind CSS |
| Metode Pengembangan | ICONIX Process |

---

## 💻 Instalasi dan Menjalankan Aplikasi

```bash
# Clone repository
git clone https://github.com/username/nama-proyek.git
cd nama-proyek

# Install dependencies
composer install
npm install && npm run dev

# Salin file environment
cp .env.example .env

# Generate key
php artisan key:generate

# Konfigurasi database di file .env
DB_DATABASE=nama_database
DB_USERNAME=root
DB_PASSWORD=

# Jalankan migrasi
php artisan migrate --seed

# Jalankan server
php artisan serve
```

Akses aplikasi melalui [http://localhost:8000](http://localhost:8000)

---

## 🧠 Metodologi Pengembangan

Sistem ini dikembangkan menggunakan **Metode ICONIX Process**, yang terdiri dari tahapan:
1. **Requirement** — Wawancara, analisis kebutuhan, dan pembuatan GUI storyboard  
2. **Analysis** — Penyusunan domain model & robustness diagram  
3. **Detailed Design** — Sequence diagram & class diagram  
4. **Implementation** — Pengkodean dengan Laravel dan pengujian black box

---

## 🔍 Pengujian

Pengujian dilakukan menggunakan **Black Box Testing**, dengan fokus pada:
- Login dan register pengguna
- Pembuatan dan persetujuan reservasi
- Transaksi pembelian obat
- Pengelolaan data produk dan kategori

Hasil pengujian menunjukkan bahwa seluruh fungsionalitas sistem berjalan **sesuai kebutuhan fungsional** tanpa error kritis.

---

## 📄 Lisensi

Proyek ini memiliki Ciptaan Program Komputer.  
Dikembangkan sebagai bagian dari penelitian skripsi oleh:

**👨‍🎓 Muhammad Abdul Aziz**  
**👨‍🎓 Dr. Eng. Adi Wibowo, S.Si.,M.Kom.**
**👨‍🎓 Etna Vianita, S.Mat., M.Mat.**
Universitas Diponegoro — Departemen Informatika (2025)

---

## 🩺 Kontak

Untuk informasi lebih lanjut:
- 📧 Email: abdulaziz.dev@gmail.com *(contoh, ganti sesuai kebutuhan)*
- 📍 Proyek ini dikembangkan untuk **Apotik dan Klinik Anggrek**
