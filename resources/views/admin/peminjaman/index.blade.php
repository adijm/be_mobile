@extends('layouts.master')

@section('title', 'Daftar Peminjaman')

@section('content')
<style>
    .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .custom-table thead th {
        background-color: #f1f5f9;
        padding: 12px 16px;
        text-align: left;
        font-weight: bold;
        font-size: 14px;
        color: #003366;
    }

    .custom-table tbody tr {
        background: #f9fcff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 123, 255, 0.08);
    }

    .custom-table tbody td {
        padding: 12px 16px;
        font-size: 14px;
        color: #333;
        vertical-align: middle;
    }

    .custom-table tbody tr:hover {
        background-color: #eaf6ff;
        transition: 0.3s;
    }

    .btn-sm {
        padding: 5px 10px;
        font-size: 13px;
        border-radius: 6px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
        margin-bottom: 20px;
    }

    .btn-primary {
        background-color: #3399ff;
        border: none;
    }
</style>

<div class="container">
    <h1 class="page-title">📖 Daftar Peminjaman</h1>

    <a href="{{ route('peminjaman.create') }}" class="btn btn-primary mb-4">+ Tambah Peminjaman</a>

    <div class="table-container">
        <table class="custom-table">
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
                        <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-outline-warning mb-1">Edit</a>
                        <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger mb-1">Hapus</button>
                        </form>

                        @if($pinjam->status == 'pending')
                        <form action="{{ route('peminjaman.acc', $pinjam->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button class="btn btn-sm btn-outline-success">Setujui</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
