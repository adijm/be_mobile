@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Daftar Peminjaman</h1>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-3">+ Tambah Peminjaman</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th>Tanggal Peminjaman</th>
                <th>Tenggat Waktu</th>
                <th>Status</th>
                <th>Tgl Kembali</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjamans as $index => $pinjam)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $pinjam->buku->title }}</td>
                <td>{{ $pinjam->user->name }}</td>
                <td>{{ $pinjam->tanggal_peminjaman }}</td>
                <td>{{ $pinjam->tenggat_waktu }}</td>
                <td>{{ ucfirst($pinjam->status) }}</td>
                <td>{{ $pinjam->tanggal_dikembalikan ?? '-' }}</td>
                <td>
                    <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
