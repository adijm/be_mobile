@extends('layouts.master')

@section('title', 'Daftar Anggota')

@section('content')
<style>
    .table-container {
        background-color: rgba(227, 244, 250, 0.7);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
        overflow-y: scroll;
        max-height: 550px;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 1000px;
    }

    .custom-table thead th {
        background-color: rgb(176, 210, 244);
        padding: 12px;
        text-align: center;
        font-weight: bold;
        font-size: 15px;
        color: rgb(9, 99, 189);
    }

    .custom-table tbody tr {
        background-color: rgb(248, 251, 255);
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.1);
    }

    .custom-table tbody td {
        padding: 12px 16px;
        font-size: 14px;
        color: #333;
        vertical-align: middle;
        text-align: center;
    }

    .custom-table tbody tr:hover {
        background-color: rgb(134, 198, 247);
        transition: 0.2s;
    }

    .btn-icon {
        background-color: transparent;
        border: none;
        font-size: 16px;
        margin: 0 5px;
    }

    .btn-edit {
        color: #fbbf24;
    }

    .btn-edit:hover {
        color: #f59e0b;
    }

    .btn-delete {
        color: #ef4444;
    }

    .btn-delete:hover {
        color: #dc2626;
    }

    .search-bar {
        display: flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 6px;
        padding: 4px 8px;
        gap: 6px;
    }

    .search-bar input[type="text"] {
        border: none;
        outline: none;
        padding: 6px;
    }

    .search-bar i {
        color: #888;
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
            <i class="fas fa-search"></i>
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
                            <a href="#" class="btn-icon btn-edit" title="Edit"><i class="fas fa-pen"></i></a>
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus anggota ini?');">
                                @csrf @method('DELETE')
                                <button class="btn-icon btn-delete" title="Hapus"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
