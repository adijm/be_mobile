@extends('layouts.master')

@section('title', 'Daftar Petugas')

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
        min-width: 1000px;
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

    .btn-icon {
        background: none;
        border: none;
        font-size: 16px;
        color: #003366;
    }

    .btn-icon:hover {
        color: #007bff;
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
                        <a href="{{ route('petugas.edit', $item->id) }}" class="btn-icon" title="Edit">
                            <i class="fas fa-pen"></i>
                        </a>
                        <form action="{{ route('petugas.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon" title="Hapus">
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
