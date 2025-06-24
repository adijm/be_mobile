@extends('layouts.master')

@section('title', 'Daftar Pengembalian')

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

    .badge {
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 12px;
        color: white;
        font-weight: 500;
    }

    .badge-kembali {
        background-color: #22c55e;
    }

    .badge-belum {
        background-color: #eab308;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <h3 class="page-title">📥 Daftar Pengembalian</h3>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>User</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tenggat Waktu</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $p)
                <tr>
                    <td>{{ $p->buku->title }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ $p->tanggal_peminjaman }}</td>
                    <td>{{ $p->tenggat_waktu }}</td>
                    <td>
                        <span class="badge {{ $p->status === 'dikembalikan' ? 'badge-kembali' : 'badge-belum' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>
                        @if($p->denda)
                            Rp {{ number_format($p->denda, 0, ',', '.') }}
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>
                        @if($p->status !== 'dikembalikan')
                        <form method="POST" action="{{ route('pengembalian.kembalikan', $p->id) }}">
                            @csrf
                            <button class="btn btn-sm btn-success">Kembalikan</button>
                        </form>
                        @else
                            <span class="text-muted">Sudah dikembalikan</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
