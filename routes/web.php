<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\PeminjamanController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\AdminApprovalController;

// --- Rute Publik ---
Route::get('/', fn() => redirect()->route('login'));
Route::get('/register', fn() => view('register'))->name('register');
Route::post('/register', [WebAuthController::class, 'register'])->name('register.process');
Route::get('/login', fn() => view('login'))->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.process');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// --- Rute Admin ---
Route::prefix('admin')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Users
    Route::resource('users', UserController::class)->names('admin.users');

    // Ruangan
    Route::resource('ruangan', RuanganController::class)->names('admin.ruangan');

    Route::resource('jadwal', JadwalController::class)->names('admin.jadwal');

    //Peminjaman
   Route::resource('peminjaman', PeminjamanController::class)->names('admin.peminjaman');
});

Route::middleware(['auth'])->group(function () {

  Route::get('/home', [HomeController::class, 'index'])->name('user.home');
  Route::get('/ruangan/{id}/jadwal', [HomeController::class, 'jadwalRuangan'])
        ->name('user.ruangan.jadwal');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('user.home');

Route::get('/admin/ruangan/{id}', [RuanganController::class, 'show'])
    ->name('admin.ruangan.jadwal');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking/create/{ruangan}', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking/store', [BookingController::class, 'store'])
        ->name('booking.store');
});

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/approval', [AdminApprovalController::class, 'index'])
        ->name('admin.approval.index');

    Route::post('/approval/{id}/approve', [AdminApprovalController::class, 'approve'])
        ->name('admin.approval.approve');

    Route::post('/approval/{id}/reject', [AdminApprovalController::class, 'reject'])
        ->name('admin.approval.reject');
});
use App\Http\Controllers\Admin\RiwayatController;

Route::middleware(['auth'])->group(function () {

    Route::get('/riwayat', [RiwayatController::class, 'index'])
        ->name('admin.riwayat.index');

    Route::get('/riwayat/{id}/edit', [RiwayatController::class, 'edit'])
        ->name('admin.riwayat.edit');

    Route::put('/riwayat/{id}', [RiwayatController::class, 'update'])
        ->name('admin.riwayat.update');
});