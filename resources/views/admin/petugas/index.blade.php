@extends('layouts.master')

@section('title', 'Daftar Petugas')

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

    .page-title {
        font-size: 24px;
        font-weight: 600;
        color: #003366;
    }

    .btn-primary {
        background-color: #3399ff;
        border: none;
    }

    .alert {
        margin-bottom: 20px;
    }
</style>

<div class="container">
    <h1 class="page-title mb-4">👮‍♂️ Daftar Petugas</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('petugas.create') }}" class="btn btn-primary">+ Tambah Petugas</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($petugas as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at ? $item->created_at->format('d-m-Y') : '-' }}</td>
                    <td>
                        <a href="{{ route('petugas.edit', $item->id) }}" class="btn-icon btn-edit" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('petugas.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">Belum ada data petugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
