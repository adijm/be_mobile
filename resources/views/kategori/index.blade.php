@extends('layouts.master')

@section('title', 'List Kategori')

@section('content')
<style>
    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
    }

    .btn-primary {
        background-color: #3399ff;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
        background-color: #007bff;
    }

    .table-container {
        background-color: rgba(227, 244, 250, 0.7);
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        overflow-x: auto;
        max-height: 550px;
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
        min-width: 800px;
    }

    .custom-table thead th {
        background-color: rgb(176, 210, 244);
        padding: 12px;
        text-align: left;
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
    }

    .custom-table tbody tr:hover {
        background-color: rgb(134, 198, 247);
        transition: 0.2s;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 8px;
    }

    .btn-icon {
        background-color: transparent;
        border: none;
        font-size: 16px;
        margin: 0 5px;
        cursor: pointer;
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
</style>

<div class="container">
    <h1 class="page-title mb-4"><i class="fas fa-book"></i> List Kategori</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('kategori.create') }}" class="btn-primary">
            <i class="fas fa-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 60px;">No</th>
                    <th>Nama Kategori</th>
                    <th style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $index => $kategori)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kategori->name }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn-icon btn-edit" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
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
