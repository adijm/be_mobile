<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    //ambil data statistik
    public function statistik() {
        $Peminjaman = Peminjaman::where('status', 'dipinjam')->count();
        $Pengembalian = Peminjaman::where('status', 'dikembalikan')->count();
        $TotalPeminjaman = Peminjaman::count();

        return response()->json([
            'peminjaman' => $Peminjaman,
            'pengembalian' => $Pengembalian,
            'totalPeminjaman' => $TotalPeminjaman,

        ], 200);
    }
}
