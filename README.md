# BananaMart

BananaMart adalah aplikasi web penjualan pisang berbasis Laravel yang dibuat untuk memenuhi tugas Ujian Akhir Semester Pemrograman Web Lanjut. Aplikasi ini mendukung autentikasi pengguna, manajemen produk, transaksi pembelian, dashboard, export laporan, REST API, serta pemisahan hak akses antara admin dan user. [file:1428]

## Identitas

- **Nama: Muhammad Rafli Daffa Aulia** 
- **NIM: 240170160** 
- **Kelas: Pemograman Web A7** 

## Deskripsi Aplikasi

BananaMart merupakan sistem penjualan pisang yang dirancang untuk membantu proses pengelolaan data produk, transaksi, dan laporan penjualan secara digital. Aplikasi ini menyediakan dua jenis pengguna, yaitu admin dan user, dengan hak akses yang berbeda sesuai kebutuhan sistem. [file:1428]

## Fitur Utama

- Autentikasi pengguna.
- Login dan registrasi.
- Verifikasi email atau autentikasi sesuai implementasi project.
- CRUD data produk.
- CRUD data transaksi.
- Dashboard berisi ringkasan data.
- Role admin dan user.
- REST API untuk data tertentu.
- Export laporan ke PDF atau Excel.
- Tampilan responsive untuk desktop dan mobile. [file:1428]

## Role Pengguna

### Admin
- Mengelola data produk.
- Mengelola data transaksi.
- Melihat dashboard.
- Mengakses export laporan.
- Mengakses fitur manajemen data.

### User
- Login ke sistem.
- Melihat produk.
- Melakukan transaksi pembelian.
- Mengunggah bukti pembayaran jika diperlukan.
- Melihat riwayat transaksi.

## Teknologi yang Digunakan

- PHP
- Laravel
- MySQL
- Blade
- Bootstrap atau CSS Laravel sesuai implementasi project
- JavaScript
- Postman untuk pengujian REST API

## Cara Instalasi

1. Clone repository ini.
2. Masuk ke folder project.
3. Install dependency Laravel menggunakan Composer.
4. Copy file `.env.example` menjadi `.env`.
5. Atur konfigurasi database pada file `.env`.
6. Generate application key.
7. Jalankan migrasi dan seeder jika tersedia.
8. Jalankan server Laravel.

Contoh perintah:

```bash
git clone https://github.com/username/bananamart.git
cd bananamart
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
```

## Konfigurasi Database

Buka file `.env`, lalu sesuaikan bagian berikut:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bananamart
DB_USERNAME=root
DB_PASSWORD=
```

## Menjalankan Aplikasi

Gunakan perintah berikut:

```bash
php artisan serve
```

Lalu buka browser:

```bash
http://127.0.0.1:8000
```

## Akun Demo

### Admin
- **Email:admin@bananamart.test**
- **Password:password123** 

### User
- **Email:pengguna1@gmail.com** [isi email user]
- **Password:pengguna1123** [isi password user]

## Struktur Fitur

### Autentikasi
Sistem menyediakan autentikasi pengguna untuk login dan registrasi. Implementasi autentikasi disesuaikan dengan kebutuhan tugas, yaitu menggunakan autentikasi Laravel dan verifikasi email atau metode lain yang dipilih. [file:1428]

### CRUD
Aplikasi memiliki fitur CRUD lengkap untuk mengelola data utama seperti produk dan transaksi. Fitur ini menjadi salah satu komponen wajib dalam tugas UAS. [file:1428]

### Dashboard
Dashboard menampilkan informasi ringkas seperti jumlah produk, jumlah transaksi, dan data lain yang relevan untuk admin. Dashboard juga menjadi salah satu fitur tambahan yang diminta dalam tugas. [file:1428]

### Role Admin dan User
Sistem memisahkan hak akses admin dan user sehingga setiap pengguna hanya dapat mengakses fitur sesuai perannya. Pemisahan hak akses ini termasuk komponen wajib penilaian. [file:1428]

### Export Laporan
Aplikasi menyediakan export laporan ke PDF atau Excel sesuai implementasi project. Fitur export juga termasuk komponen penilaian tugas. [file:1428]

### REST API
Aplikasi menyediakan endpoint API untuk kebutuhan integrasi atau pengujian menggunakan Postman. Dokumentasi hasil pengujian API perlu disertakan di README. [file:1428]

## Dokumentasi Screenshot

> Simpan semua screenshot di folder:
>
> `public/screenshots/`
>
> atau
>
> `storage/app/public/screenshots/` lalu jalankan `php artisan storage:link`.

### 1. Halaman Login
![Halaman Login](Screenshot/login.png)

### 2. Halaman Registrasi
![Halaman Registrasi](Screenshot/register.png)

### 3. Verifikasi Email / Google Login
![Verifikasi Email](Screenshot/login.png)

### 4. Dashboard Admin
![Dashboard Admin](Screenshot/dashboardadmin.png)

### 5. Dashboard User
![Dashboard User](Screenshot/dahsboarduser.png)

### 6. CRUD Produk
![CRUD Produk](Screenshot/crud.png)

### 7. CRUD Transaksi
![CRUD Transaksi](Screenshot/crudtransaksi.png)

### 8. Role Admin dan User
![Role Admin dan User](Screenshot/dashboardadmin.png)
![Role Admin dan User](Screenshot/dashboarduser.png)

### 9. REST API di Postman
![REST API Postman](Screenshot/postman.png)

### 10. Tampilan Responsive Desktop
![Responsive Desktop](Screenshot/responsive1.png)

### 11. Tampilan Responsive Mobile
![Responsive Mobile](Screenshot/responsive.png)

### 12. Export PDF
![Export PDF](Screenshot/export-pdf.png)

### 13. Export Excel
![Export Excel](Screenshot/exportexcel1.png)

Kalau foto disimpan di `storage/app/public/screenshots`, maka:
1. jalankan:
```bash
php artisan storage:link
```

2. lalu untuk dipanggil di Blade Laravel gunakan:
```php
<img src="{{ asset('storage/screenshots/dashboard-admin.png') }}" alt="Dashboard Admin">
```

3. tetapi untuk file `README.md` di GitHub, lebih aman tetap gunakan folder:
```text
public/screenshots/
```
agar gambar langsung tampil di repository.

## Contoh Pemanggilan Foto di Blade Laravel

Kalau kamu ingin menampilkan gambar di halaman aplikasi Laravel, gunakan:

```php
<img src="{{ asset('images/banana.png') }}" alt="Banana Image">
```

Kalau file ada di:
```text
public/images/banana.png
```

maka pemanggilannya:

```php
<img src="{{ asset('images/banana.png') }}" alt="Banana Image">
```

Kalau file ada di:
```text
storage/app/public/images/banana.png
```

maka jalankan dulu:

```bash
php artisan storage:link
```

lalu panggil dengan:

```php
<img src="{{ asset('storage/images/banana.png') }}" alt="Banana Image">
```

## Contoh Struktur Folder Screenshot

```text
bananamart/
├── app/
├── public/
│   └── screenshots/
│       ├── login.png
│       ├── register.png
│       ├── verifikasi-email.png
│       ├── dashboard-admin.png
│       ├── dashboard-user.png
│       ├── crud-produk.png
│       ├── crud-transaksi.png
│       ├── role-admin-user.png
│       ├── api-postman.png
│       ├── responsive-desktop.png
│       ├── responsive-mobile.png
│       ├── export-pdf.png
│       └── export-excel.png
├── resources/
├── routes/
└── README.md
```

## Endpoint API Contoh

Berikut contoh endpoint API yang dapat diuji menggunakan Postman:

- `GET /api/products`
- `POST /api/products`
- `GET /api/transactions`
- `POST /api/transactions`

> Sesuaikan kembali dengan route API yang benar pada project kamu.

## Kelebihan Aplikasi

- Memudahkan pengelolaan penjualan pisang.
- Memiliki tampilan responsive.
- Memisahkan akses admin dan user.
- Mendukung dokumentasi dan pengujian API.
- Mendukung export laporan. [file:1428]

## Penutup

Project BananaMart dibuat sebagai bentuk implementasi materi Pemrograman Web Lanjut dengan menerapkan autentikasi, CRUD, role management, dashboard, REST API, export laporan, serta dokumentasi GitHub README sesuai ketentuan tugas. [file:1428]