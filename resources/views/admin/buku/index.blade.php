@extends('layouts.master')

@section('content')

<div class="container">
    <h1>Daftar Buku</h1>

    <a href="{{ route('buku.create') }}">+ Tambah Buku</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table border="1" cellpadding="8">
        <thead>
            <tr>               <th>Judul</th>
            <th>Penulis</th>
            <th>ISBN</th>
            <th>Penerbit</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Kategori</th>
            <th>Deskripsi</th>
            <th>Cover</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bukus as $buku)
                <tr>
                    <td>{{ $buku->title }}</td>
                <td>{{ $buku->author }}</td>
                <td>{{ $buku->isbn }}</td>
                <td>{{ $buku->publisher }}</td>
                <td>{{ $buku->publication_year }}</td>
                <td>{{ $buku->stock }}</td>
                <td>{{ $buku->category->name ?? '-' }}</td>
                <td>{{ Str::limit($buku->description, 100) }}</td>
                    <td>
                        @if($buku->cover_image)
                        <img src="{{ asset('storage/' . $buku->cover_image) }}" width="50">
                    @else
                        -
                    @endif

                        <a href="{{ route('buku.edit', $buku->id) }}">Edit</a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
