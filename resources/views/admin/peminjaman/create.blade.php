@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Tambah Peminjaman</h1>

    <form action="{{ route('peminjaman.store') }}" method="POST">
        @csrf

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
            <label for="userSelect" class="form-label">Peminjam</label>
            <select id="userSelect" name="user_id" class="form-select" required>
                <option value="">-- Pilih Peminjam --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}"
                        {{ old('user_id', $peminjaman->user_id ?? '') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        

        <div class="mb-3">
            <label for="tanggal_peminjaman" class="form-label">Tanggal Peminjaman</label>
            <input type="date" name="tanggal_peminjaman" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tenggat_waktu" class="form-label">Tenggat Waktu</label>
            <input type="date" name="tenggat_waktu" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="noted" class="form-label">Catatan (opsional)</label>
            <textarea name="noted" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
