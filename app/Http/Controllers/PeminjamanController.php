<?php

namespace App\Http\Controllers;

use App\Models\buku;
use App\Models\Peminjaman;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function pinjamBuku(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
        ], [
            'user_id.exists' => 'The user ID is invalid or does not exist',
            'buku_id.exists' => 'The book ID is invalid or does not exist'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 422);
        }

        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json([
                'status' => 'error',
                'message' => 'Anggota tidak ada'
            ], 404);
        }
    
        if ($user->role !== 'anggota') {
            return response()->json([
                'status' => 'error',
                'message' => 'Hanya anggota yang bisa meminjam'
            ], 403);
        }

        $book = buku::find($request->buku_id);
        if (!$book) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku tidak ada'
            ], 404);
        }
    
        if ($book->stock <= 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku habis dan sedang di pinjam yang lain'
            ], 400);
        }

            $existingLoan = Peminjaman::where('buku_id', $request->buku_id)
            ->where('user_id', $user->id)
            ->whereNotIn('status', ['dikembalikan', 'ditolak'])
            ->first();

        if ($existingLoan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Buku sedang dipinjam oleh dirimu',
            ], 409);
        }

        $randomStaff = User::whereIn('role', ['admin', 'karyawan'])->inRandomOrder()->first();

        $now = Carbon::now();
        $tenggatWaktu = $now->copy()->addDays(7);

$loan = Peminjaman::create([
    'buku_id' => $request->buku_id,
    'user_id' => $user->id, 
    'tanggal_peminjaman' => $now,
    'tenggat_waktu' => $tenggatWaktu,
    'jumlah' => 1,
    'status' => 'pending',
    'staff_id' => $randomStaff ? $randomStaff->id : null
]);

        $book->decrement('stock');

        return response()->json([
            'status' => 'success',
            'message' => 'Book loan request created successfully',
            'data' => $loan->load(['buku', 'staff','user'])
        ], 201);

        }

        public function kembalikanBuku($id)
{
    $peminjaman = Peminjaman::find($id);

    if (!$peminjaman) {
        return response()->json([
            'status' => 'error',
            'message' => 'Data peminjaman tidak ditemukan'
        ], 404);
    }

    if ($peminjaman->status === 'dikembalikan') {
        return response()->json([
            'status' => 'error',
            'message' => 'Buku sudah dikembalikan sebelumnya'
        ], 400);
    }

    $peminjaman->update([
        'status' => 'dikembalikan',
        'tanggal_dikembalikan' => now(),
    ]);

    // Tambahkan stok buku kembali
    $peminjaman->buku->increment('stock');

    return response()->json([
        'status' => 'success',
        'message' => 'Buku berhasil dikembalikan'
    ], 200);
}
public function getUserPeminjaman()
{
    $user = Auth::user();

    $peminjaman = Peminjaman::with(['buku', 'user', 'staff'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    return response()->json([
        'status' => 'success',
        'message' => 'Data peminjaman berhasil diambil',
        'data' => $peminjaman
    ]);
}

}