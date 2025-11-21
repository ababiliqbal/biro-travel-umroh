# Biro Travel Umroh (Laravel)

Proyek aplikasi web untuk Biro Travel Umroh — dibangun dengan Laravel (scaffold autentikasi menggunakan Laravel Breeze).

Persyaratan (development):

- PHP 8.1+
- Composer
- Node.js 20.19+ (disarankan) atau higher — Vite memerlukan Node >= 20.19
- NPM (atau pnpm/yarn)
- Git

Instalasi lokal:

1. Masuk ke folder proyek:

```powershell
cd "E:\KULIAH\GASAL 2025-2026\Pemrograman Web\Proyek Akhir\Biro-Travel-Umroh\biro-travel-umroh"
```

2. Salin file lingkungan dan set konfigurasi:

```powershell
copy .env.example .env
php artisan key:generate
```

3. Instal dependensi PHP:

```powershell
composer install
```

4. Instal dependensi Node dan bangun assets:

> Catatan: Jika Node.js Anda versi lama (mis. v18), jalankan `npm run build` untuk menghasilkan assets produksi. Untuk dev server (HMR), perbarui Node.js ke >= 20.19.

```powershell
npm install
npm run dev   # atau `npm run build` jika Node tidak kompatibel
```

5. Jalankan migrasi database (proyek sudah membuat `database/database.sqlite` saat instalasi):

```powershell
php artisan migrate
```

Menjalankan server lokal:

```powershell
php artisan serve
# buka http://127.0.0.1:8000
```

Git & GitHub (singkat):

```powershell
git init
git add .
git commit -m "Initial Laravel project with Breeze auth"
# buat repo di GitHub lalu:
git remote add origin https://github.com/<username>/<repo>.git
git push -u origin main
```

Catatan:
- Breeze sudah diinstal dan scaffolding autentikasi tersedia.
- Jika `npm run dev` error karena versi Node, gunakan `npm run build` untuk sementara atau tingkatkan Node menggunakan `nvm-windows`.

Jika mau, saya bisa melanjutkan: inisialisasi Git, buat commit awal, dan bantu membuat/push ke repositori GitHub.
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework. You can also check out [Laravel Learn](https://laravel.com/learn), where you will be guided through building a modern Laravel application.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

# Biro Travel Umroh (Laravel)

Repository ini berisi aplikasi Laravel untuk Biro Travel Umroh. README ini difokuskan untuk membantu kolaborator agar cepat setup lingkungan development, menjalankan aplikasi, dan mengikuti alur kontribusi yang aman.

---

## Prasyarat (development)

- PHP 8.1+ (proyek dibuat dengan PHP 8.3 lokal)
- Composer
- Node.js >= 20.19 (disarankan) — Vite memerlukan Node >= 20.19 untuk `npm run dev`
- NPM (atau pnpm/yarn)
- Git

Jika Node.js Anda versi lama (mis. v18), Anda tetap bisa membangun assets menggunakan `npm run build`, tetapi untuk development HMR/`npm run dev` upgrade Node direkomendasikan (pakai `nvm-windows`).

---

## Quick setup (untuk kolaborator)

Ikuti langkah-langkah ini setelah `git clone`:

1. Clone repo dan masuk ke folder:

```powershell
git clone https://github.com/ababiliqbal/biro-travel-umroh.git
cd biro-travel-umroh
```

2. Instal dependensi PHP:

```powershell
composer install
```

3. Salin file environment dan buat `APP_KEY`:

```powershell
copy .env.example .env
php artisan key:generate
```

4. Siapkan database (default installer membuat `database/database.sqlite`):

```powershell
# jika belum ada
php -r "file_exists('database/database.sqlite') || New-Item -ItemType File database/database.sqlite"
php artisan migrate
```

5. Instal dependensi Node dan bangun assets:

```powershell
npm install
# Untuk development (HMR) — butuh Node >= 20.19
npm run dev
# Jika Node tidak kompatibel, gunakan build produksi (assets akan tersedia di public/build):
npm run build
```

6. Jalankan server lokal:

```powershell
php artisan serve
# buka http://127.0.0.1:8000
```

---

## Panduan Git & Alur Kontribusi (singkat)

Agar tidak merusak `main`, gunakan alur feature-branch + pull request:

1. Buat branch fitur dari `main`:

```powershell
git checkout -b feature/<deskripsi-singkat>
```

2. Kerjakan perubahan, commit secara meaningful:

```powershell
git add .
git commit -m "feat: tambahkan form pemesanan"
```

3. Push branch dan buat Pull Request di GitHub:

```powershell
git push -u origin feature/<deskripsi-singkat>
# lalu buka PR via GitHub UI (akan meminta review dan menjalankan CI)
```

4. Tunggu reviewer dan status checks (CI) lulus, lalu merge via GitHub (squash/merge direkomendasikan).

Catatan keamanan & aturan repository:
- Jangan push langsung ke `main`.
- Rebase/merge `main` ke branch Anda jika ada konflik sebelum merge PR.
- Hindari force-push ke branch bersama.

---

## Running tests

Project sudah menyertakan beberapa test (PHPUnit). Jalankan:

```powershell
composer install --dev
php artisan test
# atau
./vendor/bin/phpunit
```

CI (nanti) akan menjalankan test di Pull Request untuk memastikan stabilitas.

---

## Tips Node & Vite

- Vite membutuhkan Node >= 20.19 untuk `npm run dev`. Untuk mengganti versi Node di Windows, gunakan `nvm-windows`:

```powershell
# setelah install nvm-windows
nvm install 20.19.0
nvm use 20.19.0
node -v
```

- Jika tidak bisa upgrade sekarang, jalankan `npm run build` untuk menghasilkan assets produksi di `public/build`.

---

## Contributing & komunikasi

- Silakan buka issue jika menemukan bug atau ingin fitur baru.
- Untuk kontribusi, buat PR dari branch terpisah. Sertakan deskripsi perubahan, cara mengetes, dan screenshot bila perlu.
- Kami merekomendasikan minimal 1 reviewer untuk PR; projek ini juga menggunakan CI check.

Untuk panduan kontribusi lebih lengkap, kami dapat menambahkan `CONTRIBUTING.md` dan PR templates (saya bisa bantu membuatkan).

---

Jika kamu mau, saya bisa:
- menambahkan workflow CI (`.github/workflows/ci.yml`) untuk menjalankan test pada PR, dan
- menambahkan `CONTRIBUTING.md` serta PR template.

Terima kasih — beri tahu langkah otomatis mana yang ingin saya kerjakan selanjutnya.
