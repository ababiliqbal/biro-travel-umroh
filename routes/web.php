<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- CONTROLLERS ---

// 1. Public & Auth
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController; // Bawaan Breeze

// 2. Admin Namespace (Aliasing untuk menghindari tabrakan nama)
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageDocumentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;

// 3. Jamaah Namespace
use App\Http\Controllers\Jamaah\BookingController as JamaahBookingController;
use App\Http\Controllers\Jamaah\PaymentController as JamaahPaymentController;
use App\Http\Controllers\Jamaah\ProfileController as JamaahProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ====================================================
// 1. AREA PUBLIK (Guest)
// ====================================================
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/paket', [PageController::class, 'catalog'])->name('packages.catalog');
Route::get('/paket/{package}', [PageController::class, 'showPackage'])->name('packages.show');
Route::get('/tentang-kami', [PageController::class, 'about'])->name('about');
Route::get('/kontak', [PageController::class, 'contact'])->name('contact');


// ====================================================
// 2. AREA AUTENTIKASI UMUM (Redirector)
// ====================================================

// Route ini menangani user setelah login.
// Alih-alih menampilkan view statis, kita arahkan sesuai role-nya.
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'jamaah') {
        return redirect()->route('jamaah.bookings.index');
    }

    // Admin, Manager, Marketing ke sini
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


// Route Edit Profil Bawaan Breeze (Ganti Password, Hapus Akun)
// Bisa diakses oleh semua user yang login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// ====================================================
// 3. AREA KARYAWAN (Admin, Manager, Marketing)
// ====================================================
// Kita gunakan middleware 'role' dengan parameter multi-role
Route::middleware(['auth', 'role:admin,manager,marketing'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Redirect root /admin ke dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Manajemen User
    Route::resource('users', UserController::class);

    // Manajemen Paket & Dokumen
    Route::resource('packages', PackageController::class);
    Route::resource('packages.documents', PackageDocumentController::class)->shallow();

    // Manajemen Pendaftaran (Booking)
    // Create & Store dibuka untuk fitur "Manual Booking" oleh Staff
    Route::resource('bookings', AdminBookingController::class);

    // Manajemen Pembayaran (Verifikasi)
    Route::resource('payments', AdminPaymentController::class)->only(['index', 'update']);
    // Input Pembayaran Manual oleh Admin
    Route::post('/bookings/{booking}/payments', [AdminPaymentController::class, 'store'])->name('bookings.payments.store');

    // Laporan (Biasanya hanya untuk Admin & Manager)
    Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function () {
        Route::get('/finance', 'finance')->name('finance');
        Route::get('/statistics', 'statistics')->name('statistics');
    });
});


// ====================================================
// 4. AREA JAMAAH
// ====================================================
Route::middleware(['auth', 'role:jamaah'])->prefix('jamaah')->name('jamaah.')->group(function () {

    // Profil Khusus Jamaah (KTP, Paspor)
    Route::get('/profile', [JamaahProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [JamaahProfileController::class, 'update'])->name('profile.update');

    // Transaksi Booking
    Route::post('/booking/{package}', [JamaahBookingController::class, 'store'])->name('booking.store');
    Route::get('/pendaftaran', [JamaahBookingController::class, 'index'])->name('bookings.index');
    Route::get('/pendaftaran/{booking}', [JamaahBookingController::class, 'show'])->name('bookings.show');

    // Upload Pembayaran
    Route::post('/pendaftaran/{booking}/bayar', [JamaahPaymentController::class, 'store'])->name('payments.store');
});

require __DIR__ . '/auth.php';
