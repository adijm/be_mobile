<?php

use App\Http\Controllers\Api\PengembalianApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Buku\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\StatistikController;


Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('buku', BukuController::class);
    Route::get('/buku-terbaru', [BukuController::class, 'bukuTerbaru']);
    Route::get('/search', [BukuController::class, 'search']);

    Route::get('/statistik', [StatistikController::class, 'statistik']);

    Route::apiResource('/kategori', KategoriController::class); 
    Route::get('/BukuKategori/{kategori}', [KategoriController::class, 'BukuKategori']);

    Route::post('/pinjamBuku', [PeminjamanController::class, 'pinjamBuku']);
    Route::get('/peminjaman', [PeminjamanController::class, 'getUserPeminjaman']);
    
    Route::get('/pengembalian', [PengembalianApiController::class, 'index']);
    Route::post('/pengembalian/kembalikan/{id}', [PengembalianApiController::class, 'kembalikan']);
    Route::get('/histori/{userId}', [PengembalianApiController::class, 'historiUser']);

});