<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


use App\Http\Controllers\Api\UserController;

Route::get('/admin/users', [UserController::class, 'index']);

use App\Http\Controllers\Api\RuanganApiController;

Route::get('/ruangan', [RuanganApiController::class, 'index']);
Route::get('/ruangan/{id}', [RuanganApiController::class, 'show']);
Route::post('/ruangan', [RuanganApiController::class, 'store']);

use App\Http\Controllers\Api\JadwalApiController;

Route::get('/jadwal', [JadwalApiController::class, 'index']);
Route::post('/jadwal', [JadwalApiController::class, 'store']);
Route::put('/jadwal/{id}', [JadwalApiController::class, 'update']);
Route::delete('/jadwal/{id}', [JadwalApiController::class, 'destroy']);

use App\Http\Controllers\Api\PeminjamanApiController;

    // USER
Route::get('/peminjaman/my', [PeminjamanApiController::class, 'myPeminjaman']);
Route::post('/peminjaman', [PeminjamanApiController::class, 'store']);
Route::put('/peminjaman/{id}', [PeminjamanApiController::class, 'update']);
Route::delete('/peminjaman/{id}', [PeminjamanApiController::class, 'destroy']);

    // ADMIN
Route::middleware('admin')->get('/peminjaman', [PeminjamanApiController::class, 'index']);

    // RIWAYAT PEMINJAMAN
use App\Http\Controllers\Api\RiwayatPeminjamanController;

    Route::get('/riwayat-peminjaman', 
        [RiwayatPeminjamanController::class, 'index']);

    Route::get('/riwayat-peminjaman/{id}', 
        [RiwayatPeminjamanController::class, 'show']);
