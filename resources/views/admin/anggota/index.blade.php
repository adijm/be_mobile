@extends('layouts.master')

@section('title', 'Daftar Anggota')

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
        min-width: 1500px;
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

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        color: white;
        font-weight: 500;
    }

    .badge-available {
        background-color: #22c55e;
    }

    .badge-limited {
        background-color: #eab308;
    }

    .badge-empty {
        background-color: #ef4444;
    }

    .cover-img {
        width: 50px;
        height: auto;
        border-radius: 5px;
    }

    .btn-icon {
        background: none;
        border: none;
        font-size: 16px;
        color: #003366;
    }

    .btn-icon:hover {
        color: #007bff;
    }

    .search-bar {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 20px;
    }

    .search-bar input[type="text"] {
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
    }

    .btn-primary {
        background-color: #3399ff;
        border: none;
    }
</style>

<div class="container">
    <h1 class="page-title mb-4">👤 Daftar Anggota</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">+ Tambah Anggota</a>

        <form action="{{ route('anggota.index') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Cari anggota..." value="{{ request('search') }}">
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                        <td>
                            <a href="#" class="btn-icon" title="Edit"><i class="fas fa-pen"></i></a>
                            <form action="#" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="btn-icon" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
