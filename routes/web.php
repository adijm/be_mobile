<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebAuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Web\BukuWebController;
use App\Http\Controllers\WebKategoriController;
use App\Http\Controllers\Web\PeminjamanController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [WebAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [WebAuthController::class, 'login']);

Route::middleware(['auth:web', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function() {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('/buku', BukuWebController::class);

});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/buku', BukuWebController::class);
Route::get('/buku/create', [BukuWebController::class, 'create'])->name('buku.create');

Route::get('/kategori', [WebKategoriController::class, 'index'])->name('kategori.index');
Route::resource('kategori', WebKategoriController::class);

Route::post('/logout', [WebAuthController::class, 'logout'])->name('logout');
//peminjaman web
Route::resource('peminjaman', PeminjamanController::class);

