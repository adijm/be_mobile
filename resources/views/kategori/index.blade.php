@extends('layouts.master')

@section('content')
<div class="container">
    <h1>List Kategori</h1>

    <a href="{{ route('kategori.create') }}" class="btn btn-primary mb-3">+ Tambah Kategori</a>

    <table class="table table-bordered">
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
