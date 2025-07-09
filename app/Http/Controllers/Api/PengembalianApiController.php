<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peminjaman;
use Carbon\Carbon;
use App\Models\buku; // Tambahkan di atas


class PengembalianApiController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::whereIn('status', ['dipinjam', 'terlambat'])->with('buku', 'user')->get();

        foreach ($peminjaman as $item) {
            if (Carbon::now()->gt(Carbon::parse($item->tenggat_waktu)) && $item->status === 'dipinjam') {
                $selisihHari = Carbon::now()->diffInDays(Carbon::parse($item->tenggat_waktu));
                $item->status = 'terlambat';
                $item->denda = $selisihHari * 1000;
                $item->save();
            }
        }

        return response()->json($peminjaman);
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $now = Carbon::now();
        
        // Hitung denda jika sudah lewat tenggat waktu
        if ($now->gt(Carbon::parse($peminjaman->tenggat_waktu))) {
            $selisihHari = $now->diffInDays(Carbon::parse($peminjaman->tenggat_waktu));
            $peminjaman->denda = $selisihHari * 1000; // denda Rp 1000/hari
            $peminjaman->status = 'terlambat';
        } else {
            $peminjaman->denda = 0;
            $peminjaman->status = 'dikembalikan';
        }
    
        $peminjaman->tanggal_dikembalikan = $now;
        $peminjaman->selesai = 1;
        $peminjaman->save();
    
        // Tambahkan kembali stok buku
        $buku = \App\Models\buku::find($peminjaman->buku_id);
        if ($buku) {
            $buku->increment('stock');
        }
    
        return response()->json([
            'message' => 'Buku berhasil dikembalikan.',
            'denda' => $peminjaman->denda,
            'status' => $peminjaman->status
        ]);
    }
    
    public function historiUser($userId)
    {
        $riwayat = Peminjaman::where('user_id', $userId)
            ->with(['buku:id,judul', 'user:id,name']) // hanya ambil data yang perlu
            ->orderBy('tanggal_peminjaman', 'desc')
            ->get();

        return response()->json($riwayat);
    }

    
}

