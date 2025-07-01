@extends('layouts.master')

@section('title', 'List Kategori')

@section('content')
<style>
    .container {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .btn-add {
        background-color: #3399ff;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        font-size: 14px;
        font-weight: 500;
        box-shadow: 0 2px 4px rgba(0, 123, 255, 0.3);
        margin-bottom: 20px;
        text-decoration: none;
    }

    .btn-add:hover {
        background-color: #007bff;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        background-color: #f9fcff;
        border-radius: 8px;
        overflow: hidden;
    }

    .table-custom thead {
        background-color: #d8ecff;
        color: #003366;
    }

    .table-custom th, .table-custom td {
        padding: 14px 16px;
        text-align: left;
        font-size: 14px;
    }

    .table-custom th {
        text-transform: uppercase;
        font-weight: bold;
    }

    .table-custom tbody tr:hover {
        background-color: #eef7ff;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-edit {
        background-color: #facc15;
        border: none;
        color: #000;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
    }

    .btn-delete {
        background-color: #ef4444;
        border: none;
        color: white;
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 4px;
    }

    .btn-edit:hover {
        background-color:rgb(248, 212, 103);
    }

    .btn-delete:hover {
        background-color:rgb(230, 128, 128);
    }
</style>

<div class="container">
    <h1 class="page-title"><i class="fas fa-book"></i> List Kategori</h1>

    <a href="{{ route('kategori.create') }}" class="btn-add">
        <i class="fas fa-plus-circle"></i> Tambah Kategori
    </a>

    <div class="table-wrapper">
        <table class="table-custom">
            <thead>
                <tr>
                    <th style="width: 50px;">No</th>
                    <th>Nama Kategori</th>
                    <th style="width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->name }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-edit">Edit</a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
