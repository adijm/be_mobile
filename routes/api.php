<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Feed\FeedController;
use App\Http\Controllers\Buku\BukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\StatistikController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/feeds', [FeedController::class, 'index'])->middleware('auth:sanctum');
// Route::post('/feed/store', [FeedController::class, 'store'])->middleware('auth:sanctum');
// Route::post('/feed/like/{feed_id}', [FeedController::class, 'likePost'])->middleware('auth:sanctum');
// Route::post('/feed/comment/{feed_id}', [FeedController::class, 'comment'])->middleware('auth:sanctum');
// Route::get('/feed/comments/{feed_id}', [FeedController::class, 'getComments'])->middleware('auth:sanctum');

// Route::get('/test', function () {
//     return response([
//         'message' => 'Api is working'
//     ], 200);
// });

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('buku', BukuController::class);
    Route::get('/buku-terbaru', [BukuController::class, 'bukuTerbaru']);
    Route::post('/search', [BukuController::class, 'search']);

    Route::get('/statistik', [StatistikController::class, 'statistik']);

    Route::apiResource('/kategori', KategoriController::class); 
    Route::get('/BukuKategori/{kategori}', [KategoriController::class, 'BukuKategori']);

    Route::post('/pinjamBuku', [PeminjamanController::class, 'pinjamBuku']);
    
});