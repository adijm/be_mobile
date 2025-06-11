<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
    use App\Models\Buku;
    use App\Models\Peminjaman;
class DashboardController extends Controller
{
    public function index()
    {
        $jumlahAnggota = User::count();
        $jumlahBuku = Buku::count();
        $jumlahTransaksi = Peminjaman::count();
        $jumlahPending = Peminjaman::where('status', 'pending')->count();
    
        return view('admin.dashboard', compact('jumlahAnggota', 'jumlahBuku', 'jumlahTransaksi', 'jumlahPending'));
    }
}

