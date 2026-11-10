# SAMDA — Sistem Pengelolaan Bank Sampah Kampus

Website simulasi untuk UTS Pemrograman Web menggunakan Laravel, arsitektur MVC, dan Blade Template.

## Fitur
- Login simulasi menggunakan username (tanpa autentikasi sungguhan).
- Dashboard ringkasan aktivitas bank sampah.
- Halaman **Pengelolaan Setoran Sampah**: statistik (total setoran, total berat, jumlah fakultas), form tambah setoran, dan tabel daftar setoran dari seluruh fakultas.
- Data setoran disimpan di **session Laravel** (tanpa tabel database sendiri). Tabel ditampilkan dengan `@foreach` dari data yang dikirim Controller.
- Pencarian fakultas / jenis sampah pada tabel menggunakan JavaScript.
- Halaman profil yang menerima username dari request parameter.
- Navigasi responsif untuk desktop dan perangkat mobile.

## Teknologi
- Laravel 13
- PHP 8.4+ (sesuai `composer.lock` project ini)
- Blade Template, CSS, JavaScript

## Struktur file utama
```text
routes/
└── web.php
app/Http/Controllers/
└── PageController.php
resources/views/
├── layouts/app.blade.php
├── login.blade.php
├── dashboard.blade.php
├── pengelolaan.blade.php
├── profile.blade.php
└── components/
    ├── navbar.blade.php
    └── footer.blade.php
public/
├── css/style.css
└── js/app.js
```

## Cara menjalankan
Folder `vendor`, file `.env`, dan database SQLite sudah ada di dalam project ini, jadi tidak perlu membuat project Laravel baru.

1. Pastikan PHP 8.4+ sudah terpasang (`php -v`).
2. Buka terminal di folder project, lalu jalankan:
   ```bash
   php artisan serve
   ```
3. Buka alamat `http://127.0.0.1:8000`.

Jika muncul pesan *No application encryption key*, jalankan `php artisan key:generate`.
Jika muncul pesan *no such table: sessions*, jalankan `php artisan migrate`.

## Cara mencoba
1. Masukkan nama pengguna pada halaman login, misalnya `Raihan`, lalu klik **Masuk ke Dashboard**.
2. Buka menu Dashboard, Pengelolaan, dan Profil.
3. Pada Pengelolaan, isi form **Tambah Setoran Sampah** (fakultas, jenis sampah, kategori, berat, dan tanggal, semuanya diisi manual) lalu klik **Simpan Setoran**. Data baru muncul di urutan teratas dan statistik ikut berubah.
4. Coba kolom pencarian pada **Daftar Setoran Sampah**.

## Catatan implementasi UTS
- Tidak menggunakan tabel database sendiri, autentikasi, maupun CRUD lengkap. Setoran hanya ditambahkan dan disimpan di session.
- Login hanya simulasi. Username diteruskan melalui query parameter setelah form dikirim.
- `@extends`, `@section`, `@yield`, `@include`, Blade component (`<x-navbar>`), dan `@foreach` digunakan dalam project. File footer dipanggil melalui `@include('components.footer')`.
- Data contoh dapat diganti sesuai kebutuhan. Jangan menyatakan data simulasi sebagai data transaksi nyata.

## Identitas untuk pengumpulan
- Nama repository: `UTS_PWEB_252410102086`
- Deskripsi repository: Sistem Pengelolaan Bank Sampah Kampus berbasis Laravel MVC.
- Pastikan repository GitHub bersifat **Public** dan README dilengkapi screenshot hasil website.
