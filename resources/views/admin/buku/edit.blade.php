@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Buku</h1>

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" id="title" class="form-control" 
                value="{{ old('title', $buku->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="author" class="form-label">Penulis</label>
            <input type="text" name="author" id="author" class="form-control" 
                value="{{ old('author', $buku->author) }}" required>
        </div>

        <div class="mb-3">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" name="isbn" id="isbn" class="form-control" 
                value="{{ old('isbn', $buku->isbn) }}" required>
        </div>

        <div class="mb-3">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" name="publisher" id="publisher" class="form-control" 
                value="{{ old('publisher', $buku->publisher) }}" required>
        </div>

        <div class="mb-3">
            <label for="publication_year" class="form-label">Tahun Terbit</label>
            <input type="number" name="publication_year" id="publication_year" class="form-control" 
                value="{{ old('publication_year', $buku->publication_year) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Kategori</label>
            <select name="category_id" id="category_id" class="form-select" required>
                @foreach($kategoris as $category)
                    <option value="{{ $category->id }}" 
                        {{ old('category_id', $buku->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="stock" class="form-label">Stok</label>
            <input type="number" name="stock" id="stock" class="form-control" 
                value="{{ old('stock', $buku->stock) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $buku->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Cover Buku</label>
            <input type="file" name="cover_image" id="cover_image" class="form-control" accept="image/*">
            @if($buku->cover_image)
                <p>Gambar saat ini: <br>
                <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Cover Buku" style="max-width:150px;"></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <a href="{{ route('buku.index') }}" class="btn btn-secondary mt-3">← Kembali</a>
</div>
@endsection
