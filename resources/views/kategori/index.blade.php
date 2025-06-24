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
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.1);
    }

    .table-custom thead {
        background: linear-gradient(to right, #cce9ff, #e6f3ff);
        font-weight: bold;
        color: #003366;
    }

    .table-custom th,
    .table-custom td {
        padding: 12px 15px;
        border-bottom: 1px solid #e0f0ff;
        text-align: left;
        font-size: 14px;
    }

    .table-custom tbody tr:hover {
        background-color: #f2faff;
        transition: background 0.3s ease;
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #003366;
        margin-bottom: 20px;
    }

    .btn-primary {
        background: #3399ff;
        border: none;
    }

    .btn-primary:hover {
        background: #007bff;
    }

    .container {
        background: rgba(255, 255, 255, 0.7);
        padding: 20px;
        border-radius: 12px;
    }
</style>

<div class="container">
    <h1 class="page-title">List Kategori</h1>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <table class="table-custom">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategoris as $index => $kategori)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $kategori->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
