# Sistem Informasi Biro Travel Umroh

Aplikasi web manajemen dan reservasi perjalanan ibadah umroh berbasis **Laravel 12**, dirancang untuk mempermudah calon jemaah dalam memilih paket perjalanan serta mengotomatisasi operasional biro travel secara terpadu.

Proyek ini dikembangkan sebagai **Proyek Akhir Mata Kuliah Pemrograman Web (Gasal 2025/2026)**.

---

## Daftar Isi

- [Tentang Proyek](#tentang-proyek)
- [Fitur Utama](#fitur-utama)
- [Hak Akses Pengguna (RBAC)](#hak-akses-pengguna-rbac)
- [Tech Stack](#tech-stack)
- [Struktur Database](#struktur-database)
- [Prasyarat Sistem](#prasyarat-sistem)
- [Panduan Instalasi Lokal](#panduan-instalasi-lokal)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Panduan Pengujian (Testing)](#panduan-pengujian-testing)
- [Alur Kerja Kolaborasi (Git Workflow)](#alur-kerja-kolaborasi-git-workflow)
- [Struktur Direktori Proyek](#struktur-direktori-proyek)
- [Lisensi](#lisensi)

---

## Tentang Proyek

Sistem Informasi Biro Travel Umroh dirancang untuk mengatasi tantangan operasional konvensional pada biro travel, seperti pencatatan transaksi manual, verifikasi pembayaran yang terfragmentasi, dan lambatnya pelaporan keuangan.

Aplikasi ini mengintegrasikan seluruh tahapan bisnis travel umroh:
1. **Etalase Digital Publik:** Membantu calon jemaah melihat katalog paket, detail fasilitas, berkas persyaratan, dan ketersediaan kuota secara transparan.
2. **Pendaftaran Mandiri & Pemberkasan:** Memfasilitasi jemaah dalam melakukan reservasi online, mengunggah data identitas (KTP & Paspor), dan melacak status keberangkatan.
3. **Manajemen Operasional & Keuangan:** Membantu tim operasional/marketing dalam mendaftarkan jemaah, memvalidasi bukti transfer, mengontrol jadwal pembayaran jatuh tempo, hingga menyajikan laporan analitik bagi pihak manajer biro.

---

## Fitur Utama

### 1. Portal Publik & Calon Jemaah
- **Katalog Paket Umroh:** Pencarian dan filter paket berdasarkan kata kunci dan tanggal keberangkatan.
- **Detail Paket Komprehensif:** Informasi rincian harga, kuota jamaah, hotel, maskapai, fasilitas, dan dokumen wajib.
- **Pemesanan Mandiri (Self Booking):** Alur pemesanan paket secara instan setelah melakukan autentikasi.
- **Profil Jemaah:** Manajemen data personal, nomor identitas KTP, nomor paspor, dan kontak darurat.
- **Upload Bukti Pembayaran:** Pengunggahan bukti transfer pembayaran (DP maupun pelunasan) dengan status verifikasi *real-time*.

### 2. Operasional Biro (Admin & Marketing)
- **Manajemen Pendaftaran (Bookings):** Registrasi jemaah secara langsung (*on-spot* oleh staf) dan pembaruan status pendaftaran (*waiting, approved, departed, completed, rejected*).
- **Pencatatan Pembayaran Manual:** Penerimaan dan pencatatan pembayaran tunai/manual dari jemaah.
- **Katalog Paket & Dokumen Persyaratan (Admin):** CRUD paket perjalanan, penentuan batas waktu pelunasan (*due date*), kuota, dan dokumen wajib.
- **Verifikasi Pembayaran (Admin):** Validasi berkas bukti transfer dengan konfirmasi status *verified* atau *failed*.
- **Manajemen Pengguna (User Management):** Pengelolaan akun staf biro dan akun jemaah.

### 3. Eksekutif & Manajemen (Manager)
- **Laporan Keuangan (Financial Report):** Ringkasan total pendapatan, riwayat transaksi pembayaran terverifikasi, dan filter berdasarkan rentang tanggal.
- **Statistik & Okupansi Paket:** Analisis keterisian kuota (*occupancy rate*), identifikasi paket terfavorit, serta paket dengan peminat terendah.
- **Monitoring Tunggakan (Late Payments):** Pelacakan jemaah yang melewati tanggal jatuh tempo pembayaran berserta akumulasi sisa tagihan.

---

## Hak Akses Pengguna (RBAC)

Aplikasi menerapkan sistem otorisasi berbasis peran (*Role-Based Access Control*) melalui middleware:

| Peran (Role) | Ruang Lingkup & Wewenang |
| :--- | :--- |
| **`jamaah`** | Mengelola profil pribadi, melakukan booking paket, melihat riwayat pendaftaran, mengunggah bukti bayar. |
| **`marketing`** | Melihat dashboard staf, membuat akun jemaah baru, mendaftarkan booking jemaah, mencatat pembayaran manual. |
| **`admin`** | Hak akses penuh: mengelola paket dan dokumen, verifikasi pembayaran transfer, manajemen seluruh user, serta mengakses laporan. |
| **`manager`** | Akses dashboard eksekutif, laporan keuangan, statistik keterisian paket, dan monitoring pembayaran jatuh tempo. |

---

## Tech Stack

### Backend
- **Bahasa Pemrograman:** PHP 8.2+
- **Framework:** [Laravel 12](https://laravel.com/) (MVC Architecture)
- **Autentikasi:** [Laravel Breeze](https://laravel.com/docs/starter-kits#laravel-breeze)
- **Database ORM:** Eloquent ORM
- **Testing:** PHPUnit & Faker

### Frontend
- **Templating Engine:** Laravel Blade
- **CSS Framework:** [Tailwind CSS](https://tailwindcss.com/) dengan `@tailwindcss/forms`
- **JavaScript UI:** [Alpine.js](https://alpinejs.dev/)
- **Build Tool:** [Vite 7](https://vite.dev/) dengan Hot Module Replacement (HMR)

### Database
- **Development:** SQLite (`database/database.sqlite`)
- **Production-Ready:** MySQL / MariaDB / PostgreSQL

---

## Struktur Database

Entitas utama yang saling berelasi di dalam sistem:

```
[ users ] 1──1 [ jamaah_profiles ]
    │
    ├──< [ bookings ] >──1 [ packages ]
    │          │                     │
    │          │                     └──1──< [ package_documents ]
    │          │
    │          └──1──< [ payments ]
    │                      │
    └──(verified_by)───────┘
```

- **`users`**: Menyimpan kredensial autentikasi dan peran (`jamaah`, `admin`, `manager`, `marketing`).
- **`jamaah_profiles`**: Data identitas pendukung jemaah (KTP, paspor, nomor telepon, alamat, tanggal lahir).
- **`packages`**: Data paket umroh (nama, harga, kuota, tanggal keberangkatan, fasilitas, gambar cover).
- **`package_documents`**: Dokumen persyaratan yang diwajibkan untuk paket tertentu.
- **`bookings`**: Transaksi reservasi jemaah terhadap paket dengan status verifikasi dan tanggal jatuh tempo.
- **`payments`**: Riwayat transaksi pembayaran, metode (online/manual), nominal, bukti pembayaran, dan staf yang memvalidasi.

---

## Prasyarat Sistem

Sebelum memulai instalasi, pastikan sistem lokal Anda telah terpasang:

- **PHP** >= 8.2 (dengan ekstensi `pdo`, `sqlite3`, `mbstring`, `openssl`, `curl`)
- **Composer** >= 2.2
- **Node.js** >= 20.19.0 (Rekomendasi)
- **NPM** atau Package Manager alternatif (Yarn / PNPM)
- **Git**

---

## Panduan Instalasi Lokal

Ikuti langkah-langkah berikut untuk mengatur proyek di lingkungan lokal:

### 1. Kloning Repositori
```bash
git clone https://github.com/ababiliqbal/biro-travel-umroh.git
cd biro-travel-umroh
```

### 2. Instal Dependensi Backend
```bash
composer install
```

### 3. Konfigurasi Environment
Salin file template `.env.example` menjadi `.env`, lalu generate application key:
```bash
# Windows (PowerShell / CMD)
copy .env.example .env

# Linux / macOS
cp .env.example .env

php artisan key:generate
```

### 4. Konfigurasi Database & Migrasi
Secara default, proyek telah terkonfigurasi menggunakan **SQLite**. Buat berkas database SQLite jika belum ada, lalu jalankan migrasi:

```bash
# Windows PowerShell
if (!(Test-Path "database\database.sqlite")) { New-Item -ItemType File "database\database.sqlite" }

# Linux / macOS
touch database/database.sqlite

# Eksekusi migrasi skema tabel
php artisan migrate
```

*(Opsional)* Jika Anda ingin menggunakan database **MySQL**, sesuaikan konfigurasi pada file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=biro_travel_umroh
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Instal Dependensi Frontend & Kompilasi Asset
```bash
npm install

# Untuk kebutuhan development (Vite HMR)
npm run dev

# Atau kompilasi untuk aset produksi
npm run build
```

---

## Menjalankan Aplikasi

Anda dapat menjalankan server aplikasi melalui beberapa opsi berikut:

### Opsi A: Eksekusi Tunggal (Artisan Serve)
Buka terminal dan jalankan server web lokal:
```bash
php artisan serve
```
Buka peramban di `http://127.0.0.1:8000`.

### Opsi B: Mode Pengembangan Penuh (Concurrent Runner)
Jika ingin menjalankan web server, queue listener, log viewer (*pail*), dan Vite secara bersamaan dalam satu jendela terminal:
```bash
composer run dev
```

---

## Panduan Pengujian (Testing)

Proyek ini telah dilengkapi dengan unit dan feature test untuk memastikan keandalan alur autentikasi dan fungsionalitas utama:

```bash
# Menjalankan test suite Laravel
php artisan test

# Atau menggunakan binary PHPUnit langsung
./vendor/bin/phpunit
```

---

## Alur Kerja Kolaborasi (Git Workflow)

Untuk menjaga stabilitas kode pada branch `main`, seluruh kontributor diharapkan menerapkan alur kerja berbasis fitur (*Feature Branching Workflow*):

1. **Sinkronkan branch utama:**
   ```bash
   git checkout main
   git pull origin main
   ```
2. **Buat branch fitur baru:**
   ```bash
   git checkout -b feature/nama-fitur-singkat
   ```
3. **Commit perubahan secara berkala:**
   Gunakan konvensi commit yang jelas (misalnya: *Conventional Commits*):
   ```bash
   git commit -m "feat: tambahkan validasi dokumen paspor pada form booking"
   ```
4. **Push branch dan buka Pull Request (PR):**
   ```bash
   git push -u origin feature/nama-fitur-singkat
   ```
5. Tunggu proses review dan pastikan tidak terdapat konflik sebelum branch digabungkan (*merge*) ke `main`.

---

## Struktur Direktori Proyek

Ringkasan direktori inti aplikasi:

```text
biro-travel-umroh/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # Controller untuk Admin & Manager (Paket, Laporan, Pembayaran)
│   │   │   ├── Jamaah/         # Controller transaksi dan profil jemaah
│   │   │   ├── Auth/           # Controller autentikasi (Breeze)
│   │   │   └── PageController.php # Halaman publik (Katalog, Beranda, Kontak)
│   │   └── Middleware/         # Middleware RBAC (EnsureUserHasRole)
│   └── Models/                 # Eloquent Model (User, Package, Booking, Payment, dll)
├── database/
│   ├── migrations/             # Skema tabel database
│   └── seeders/                # Data awal untuk pengujian
├── resources/
│   ├── views/
│   │   ├── admin/              # Tampilan antarmuka dashboard staf & manajemen
│   │   ├── jamaah/             # Tampilan panel dan reservasi jemaah
│   │   ├── public/             # Tampilan beranda dan katalog publik
│   │   └── layouts/            # Template Blade utama
│   ├── css/                    # Konfigurasi Tailwind CSS
│   └── js/                     # Skrip JavaScript & Alpine.js
├── routes/
│   ├── web.php                 # Rute utama aplikasi web
│   └── auth.php                # Rute autentikasi bawaan Breeze
└── tests/                      # Skrip pengujian otomatis (Feature & Unit)
```

---

## Lisensi

Proyek ini dikembangkan untuk kebutuhan akademik di lingkungan perkuliahan dan didistribusikan di bawah lisensi [MIT](LICENSE).
