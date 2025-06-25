<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\AnggotaController;
use App\Http\Controllers\Web\BukuWebController;
use App\Http\Controllers\WebKategoriController;
use App\Http\Controllers\Web\PeminjamanController;
use App\Http\Controllers\Web\PengembalianController;
use App\Http\Controllers\Web\PetugasController;

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

    
    //anggota
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/anggota', [AnggotaController::class, 'index'])->name('anggota.index');
    Route::get('/anggota/create', [AnggotaController::class, 'create'])->name('anggota.create');
    Route::post('/anggota', [AnggotaController::class, 'store'])->name('anggota.store');
});

Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [PetugasController::class, 'index'])->name('index');
    Route::get('/create', [PetugasController::class, 'create'])->name('create');
    Route::post('/', [PetugasController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [PetugasController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PetugasController::class, 'update'])->name('update');
    Route::delete('/{id}', [PetugasController::class, 'destroy'])->name('destroy');
});


});
