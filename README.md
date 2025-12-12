# Pendaftaran Lomba & Sertifikasi RIIB

Aplikasi Laravel untuk mengelola pendaftaran persiapan lomba mahasiswa dan sertifikasi pembina di lingkungan RIIB. Repo ini berisi portal publik untuk mahasiswa/pembina, dashboard admin, serta panel dosen pembimbing.

## Fitur Utama
- **Portal publik** – halaman informasi dan formulir pendaftaran lomba/sertifikasi.
- **Dashboard admin** – memantau pendaftaran, mengunduh data, serta membuat akun dosen pembimbing.
- **Dashboard dosen** – melihat hanya pendaftaran lomba yang relevan.
- **Autentikasi multi-guard** – pemisahan akses `admin` dan `lecturer`.

## Struktur Proyek
| Lokasi | Deskripsi |
| --- | --- |
| `resources/views/modules/` | Seluruh view dipetakan per modul (`lomba`, `sertifikasi`, `admin`, `dosen`, `auth`). Setiap view publik mewarisi layout `resources/views/layouts/guest.blade.php` agar styling konsisten. |
| `resources/views/components/` | Blade component yang bisa digunakan ulang di berbagai modul. |
| `routes/web.php` | Rute publik (portal, formulir, autentikasi) beserta dokumentasinya. |
| `routes/admin.php` & `routes/lecturer.php` | Rute dashboard dipisah per guard untuk memudahkan scaling. |
| `app/Http/Controllers` | Logika pendaftaran lomba/sertifikasi, autentikasi, dan manajemen akun dosen. |

## Menjalankan Secara Lokal
1. **Persiapan**
   ```bash
   cp .env.example .env
   composer install
   npm install
   php artisan key:generate
   ```
2. **Migrasi & seeder opsional** – jalankan jika menggunakan database baru:
   ```bash
   php artisan migrate --seed
   ```
3. **Menjalankan server & Vite**
   ```bash
   php artisan serve
   npm run dev
   ```
4. **Pengguna awal** – buat akun admin/dosen melalui seeder atau langsung via form admin setelah login sebagai admin.

## Testing
Jalankan seluruh pengujian feature/unit dengan:
```bash
php artisan test
```

## API

Endpoint API dapat diakses melalui prefix `/api/v1` tanpa memerlukan session browser. Gunakan header `Accept: application/json` ketika mengirimkan request.

- **Alur pendaftaran** – `GET /api/v1/flows/{type}` dengan nilai `{type}` `lomba` atau `sertifikasi` untuk mendapatkan langkah-langkah yang diatur admin.
- **Pendaftaran lomba** – `GET /api/v1/registrations/lomba` untuk daftar pendaftar, `POST /api/v1/registrations/lomba` dengan payload `nama`, `nim`, `program_studi`, `whatsapp`, `pilihan_peran`, `motivasi`, `status_tim` untuk membuat data baru.
- **Pendaftaran sertifikasi** – `GET /api/v1/registrations/sertifikasi` untuk daftar pendaftar, `POST /api/v1/registrations/sertifikasi` dengan payload `nama`, `nip`, `program_studi`, `whatsapp`, `tanggal_pelaksanaan`, serta file `poster_sertifikasi` (gambar) untuk membuat data baru.

Kontribusi dan perbaikan dipersilakan melalui pull request.
