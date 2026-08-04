# Deployment Production SMAN 2 Balige

Dokumen ini adalah checklist operasional. Nilai rahasia wajib disimpan di
environment server dan tidak boleh masuk Git.

## Prasyarat server

- PHP 8.3 atau lebih baru beserta ekstensi Laravel yang diperlukan.
- MySQL/MariaDB, Composer 2, Node.js LTS, dan web server Nginx/Apache.
- Document root diarahkan ke direktori `public/`.
- HTTPS aktif dengan sertifikat yang masih berlaku.
- Proses queue worker dan cron tersedia.
- Database dan direktori upload memiliki backup terjadwal.

## Environment

1. Salin `.env.production.example` menjadi `.env` hanya di server.
2. Ganti domain, database, SMTP, email admin, dan seluruh placeholder rahasia.
3. Jalankan `php artisan key:generate` satu kali pada instalasi baru.
4. Jangan mengganti `APP_KEY` setelah data production digunakan.
5. Pastikan `APP_DEBUG=false`, `APP_FORCE_HTTPS=true`, dan
   `SESSION_SECURE_COOKIE=true`.

`ADMIN_INITIAL_PASSWORD` hanya digunakan saat akun admin pertama belum ada.
Seeder tidak akan mengganti password akun yang sudah ada. Password awal harus
unik dan disampaikan melalui kanal yang aman.

## Prosedur deployment

```bash
composer install --no-dev --classmap-authoritative
npm ci
npm run build
php artisan migrate --force
php artisan storage:link
php artisan optimize
php artisan queue:restart
```

Sebelum migration pertama, buat backup database dan periksa
`php artisan migrate:status`. Migration legacy teacher telah dibuat non-
destruktif; penghapusan data lama harus menjadi pekerjaan terpisah dengan
persetujuan sekolah.

## Queue dan scheduler

Jalankan queue worker menggunakan Supervisor, systemd, atau process manager
hosting:

```bash
php artisan queue:work --sleep=3 --tries=3 --max-time=3600
```

Tambahkan satu cron job:

```cron
* * * * * cd /path/aplikasi && php artisan schedule:run >> /dev/null 2>&1
```

Scheduler membersihkan token reset password kedaluwarsa dan failed jobs lama.

## Backup

Backup wajib mencakup:

- Database MySQL/MariaDB.
- `storage/app/public`.
- File `.env` melalui secret manager atau penyimpanan terenkripsi.

Gunakan fitur backup hosting atau job database terpisah. Simpan minimal satu
salinan di lokasi berbeda, gunakan retensi harian dan mingguan, lalu lakukan
uji restore sebelum peluncuran. Backup yang belum pernah diuji restore belum
dianggap valid.

## Setelah deployment

```bash
php artisan about --only=environment
php artisan migrate:status
php artisan schedule:list
php artisan config:show session
```

Kemudian periksa:

- `/up` mengembalikan HTTP 200.
- `/robots.txt` dan `/sitemap.xml` memakai domain HTTPS production.
- Reset password benar-benar diterima email admin.
- Login, logout, upload gambar, draft/published, dan halaman publik normal.
- Halaman 403, 404, 419, 429, 500, dan 503 tidak menampilkan stack trace.
- Permission tulis hanya diberikan pada `storage/` dan `bootstrap/cache/`.

## Rollback

Sebelum release, catat commit yang sedang aktif dan lokasi backup. Jika terjadi
gangguan, aktifkan maintenance mode, kembalikan artifact release sebelumnya,
restore database hanya bila perubahan skema/data memang mengharuskannya, lalu
jalankan `php artisan optimize`.
