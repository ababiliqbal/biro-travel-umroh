<?php

use App\Http\Controllers\Admin\PackageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Jamaah\ProfileController as JamaahProfileController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('packages', PackageController::class);
});

Route::middleware(['auth'])->prefix('jamaah')->name('jamaah.')->group(function () {
    Route::get('/profile', [JamaahProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [JamaahProfileController::class, 'update'])->name('profile.update');
});

require __DIR__ . '/auth.php';
