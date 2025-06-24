<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\BukuWebController;
use App\Http\Controllers\WebKategoriController;
use App\Http\Controllers\Web\PeminjamanController;
use App\Http\Controllers\Web\PengembalianController;

Route::get('/', function () {
    return view('welcome');
});

// ================== AUTH ==================
Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login'])->name('login.process');
Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');

// ================== PROTECTED ROUTES ==================
Route::middleware(['auth:web', 'role:admin'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Buku
    Route::resource('/buku', BukuWebController::class);
    
    // Kategori
    Route::resource('kategori', WebKategoriController::class);

    // Peminjaman
    Route::resource('peminjaman', PeminjamanController::class);
    Route::post('/peminjaman/{id}/acc', [PeminjamanController::class, 'acc'])->name('peminjaman.acc');

    // Pengembalian
    Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
    Route::post('/pengembalian/kembalikan/{id}', [PengembalianController::class, 'kembalikan'])->name('pengembalian.kembalikan');

    // Users (jika hanya tampilan statis sementara)
    Route::get('/users', function () {
        return view('admin.users.index');
    })->name('users.index');

});
