<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\PackageDocumentController;
use App\Http\Controllers\Jamaah\ProfileController as JamaahProfileController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Routes untuk Profile User Umum
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Routes Admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // User Management
    Route::resource('users', UserController::class);

    // Packages CRUD
    Route::resource('packages', PackageController::class);

    // Package Documents CRUD
    Route::resource('package-documents', PackageDocumentController::class);
    // Dengan ini, semua route CRUD Laravel default jalan:
    // index, create, store, show, edit, update, destroy
});

/*
|--------------------------------------------------------------------------
| Routes Jamaah (Profile Jamaah)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('jamaah')->name('jamaah.')->group(function () {
    Route::get('/profile', [JamaahProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [JamaahProfileController::class, 'update'])->name('profile.update');
});

/*
|--------------------------------------------------------------------------
| Route Booking (Umum dan Jamaah)
|--------------------------------------------------------------------------
*/
Route::resource('bookings', BookingController::class)->middleware('auth');

require __DIR__ . '/auth.php';
