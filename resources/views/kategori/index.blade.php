@extends('layouts.master')

@section('content')
<style>
    .table-custom {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background-color: #ffffff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 123, 255, 0.1);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .table-custom thead {
        background: linear-gradient(to right, #cce9ff, #e6f3ff);
        font-weight: bold;
        color: #003366;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom th,
    .table-custom td {
        padding: 16px 20px;
        border-bottom: 1px solid #e0f0ff;
        text-align: left;
        font-size: 14px;
        vertical-align: middle;
    }

    .table-custom tbody tr:hover {
        background-color: #f2faff;
        transition: background 0.3s ease;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #003366;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .page-title i {
        color: #3399ff;
    }

    .btn-primary {
        background: #3399ff;
        border: none;
        padding: 10px 18px;
        font-weight: 500;
        font-size: 14px;
        border-radius: 6px;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
    }

    .btn-primary:hover {
        background: #007bff;
    }

    .container {
        background: rgba(255, 255, 255, 0.8);
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .table-number {
        font-weight: bold;
        color: #3399ff;
    }

    .category-name {
        font-weight: 500;
    }
</style>

<div class="container">
    <h1 class="page-title"><i class="fas fa-book"></i> List Kategori</h1>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">
        <i class="fas fa-plus-circle"></i> Tambah Kategori
    </a>

    <table class="table-custom">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $index => $kategori)
                <tr>
                    <td class="table-number">{{ $index + 1 }}</td>
                    <td class="category-name">{{ $kategori->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Tambahkan CDN Font Awesome untuk ikon jika belum ada -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
@endsection
