<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->with('buku', 'user')->get();
    
        // Cek keterlambatan
        foreach ($peminjaman as $item) {
            if (Carbon::now()->gt(Carbon::parse($item->tenggat_waktu)) && $item->status === 'dipinjam') {
                $selisihHari = Carbon::now()->diffInDays(Carbon::parse($item->tenggat_waktu));
                $item->status = 'terlambat';
                $item->denda = $selisihHari * 1000; // contoh: Rp 1000 per hari
                $item->save();
            }
        }
    
        return view('admin.pengembalian.index', compact('peminjaman'));
    }
    
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->tanggal_dikembalikan = Carbon::now();
        $peminjaman->status = 'dikembalikan';
        $peminjaman->selesai = 1;
        $peminjaman->save();
    
        return redirect()->back()->with('success', 'Buku berhasil dikembalikan.');
    }

}