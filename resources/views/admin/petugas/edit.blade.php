@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Edit Petugas</h1>

    <form action="{{ route('petugas.update', $petugas->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="name" class="form-control" value="{{ $petugas->name }}" required>
        </div>

        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="{{ $petugas->username }}" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $petugas->email }}" required>
        </div>

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
