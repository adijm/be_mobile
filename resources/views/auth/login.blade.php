@extends('layouts.guest')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-4">
        <h2 class="text-center mb-4">Masuk Admin</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="Nama pengguna" required>
            </div>
            <div class="form-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="Kata sandi" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</div>
@endsection
