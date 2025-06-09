@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Peminjaman</h1>

    <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="bukuSelect" class="form-label">Judul Buku</label>
            <select id="bukuSelect" name="buku_id" class="form-select" required>
                <option value="">-- Pilih Buku --</option>
                @foreach($bukus as $buku)
                    <option value="{{ $buku->id }}" 
                        {{ old('buku_id', $peminjaman->buku_id ?? '') == $buku->id ? 'selected' : '' }}>
                        {{ $buku->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="user_id" class="form-label">Peminjam</label>
            <select name="user_id" class="form-select" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="staff_id" class="form-label">Petugas (Opsional)</label>
            <select name="staff_id" class="form-select">
                <option value="">-- Tidak ada --</option>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $peminjaman->staff_id == $staff->id ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" class="form-control" value="{{ $peminjaman->tanggal_peminjaman }}" required>
        </div>

        <div class="mb-3">
            <label for="tenggat_waktu" class="form-label">Tenggat Waktu</label>
            <input type="date" name="tenggat_waktu" class="form-control" value="{{ $peminjaman->tenggat_waktu }}" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Buku</label>
            <input type="number" name="jumlah" class="form-control" value="{{ $peminjaman->jumlah }}" required>
        </div>

        <div class="mb-3">
            <label for="noted" class="form-label">Catatan</label>
            <textarea name="noted" class="form-control">{{ $peminjaman->noted }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                @foreach(['pending','dipinjam','dikembalikan','ditolak','terlambat','kompensasi'] as $status)
                    <option value="{{ $status }}" {{ $peminjaman->status == $status ? 'selected' : '' }}>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="tanggal_dikembalikan" class="form-label">Tanggal Dikembalikan</label>
            <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ $peminjaman->tanggal_dikembalikan }}">
        </div>

        <div class="mb-3">
            <label for="selesai" class="form-label">Nilai Selesai (opsional)</label>
            <input type="number" name="selesai" class="form-control" value="{{ $peminjaman->selesai }}">
        </div>

        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
