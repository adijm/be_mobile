@extends('layouts.master')

@section('title', 'Daftar Buku')

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
        min-width: 1200px;
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
        max-width: 200px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .custom-table tbody tr:hover {
        background-color:rgb(134, 198, 247);
        transition: 0.2s;
    }

    .badge {
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 12px;
        color: white;
        font-weight: 600;
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
        border-radius: 6px;
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
    <h1 class="page-title mb-4">📚 Daftar Buku</h1>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{{ route('buku.create') }}" class="btn btn-primary">+ Tambah Buku</a>

        <form action="{{ route('buku.index') }}" method="GET" class="search-bar">
            <input type="text" name="search" placeholder="Cari buku..." value="{{ request('search') }}">
        </form>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>ISBN</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Stok</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Cover</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($bukus as $buku)
                    <tr>
                        <td>{{ $buku->title }}</td>
                        <td>{{ $buku->author }}</td>
                        <td>{{ $buku->isbn }}</td>
                        <td>{{ $buku->publisher }}</td>
                        <td>{{ $buku->publication_year }}</td>
                        <td>
                            <span class="badge 
                                {{ $buku->stock > 5 ? 'badge-available' : ($buku->stock > 0 ? 'badge-limited' : 'badge-empty') }}">
                                {{ $buku->stock }}
                            </span>
                        </td>
                        <td>{{ $buku->category->name ?? '-' }}</td>
                        <td>{{ $buku->description }}</td>
                        <td>
                            @if ($buku->cover_image)
                            <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Cover" class="cover-img">


                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn-icon btn-edit" title="Edit">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus?');">
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
                        <td colspan="10" class="text-center">Belum ada data buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
