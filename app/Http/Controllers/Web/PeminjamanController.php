<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\User;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['buku', 'user', 'staff'])->latest()->get();
        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::all();
        $bukus = Buku::all();
        return view('admin.peminjaman.create', compact('users', 'bukus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_peminjaman' => 'required|date',
            'tenggat_waktu' => 'required|date|after_or_equal:tanggal_peminjaman',
            'jumlah' => 'required|integer|min:1',
            'noted' => 'nullable|string',
        ]);

        $validated['status'] = 'dipinjam';
        $validated['staff_id'] = auth()->id(); // anggap petugas login
        $validated['selesai'] = 0;

        Peminjaman::create($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::with(['buku', 'user', 'staff'])->findOrFail($id);
        return view('admin.peminjaman.show', compact('peminjaman'));
    }

    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::all();
        $bukus = Buku::all();
        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'bukus'));
    }

    public function update(Request $request, $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $validated = $request->validate([
            'buku_id' => 'required|exists:bukus,id',
            'user_id' => 'required|exists:users,id',
            'tanggal_peminjaman' => 'required|date',
            'tenggat_waktu' => 'required|date|after_or_equal:tanggal_peminjaman',
            'jumlah' => 'required|integer|min:1',
            'noted' => 'nullable|string',
            'status' => 'required|in:pending,dipinjam,dikembalikan,ditolak,terlambat,kompensasi',
            'tanggal_dikembalikan' => 'nullable|date',
        ]);

        $peminjaman->update($validated);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dihapus.');
    }
}
