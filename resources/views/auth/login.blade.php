@extends('layouts.guest')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        background: linear-gradient(to bottom right, #eaf6ff, #ffffff);
        font-family: 'Poppins', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .container {
        display: flex;
        background: white;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        max-width: 900px;
        width: 100%;
        height: 500px;
    }

    .image-side {
        flex: 1;
        background-image: url('/images/login-library.jpg');
        background-position: center;
        background-size: cover;
        background-repeat: no-repeat;
    }

    .login-wrapper {
        flex: 1;
        padding: 40px 32px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .login-title {
        text-align: center;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #222;
    }

    .login-subtext {
        text-align: center;
        font-size: 13px;
        color: #777;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        width: 90%;
        padding: 12px 16px;
        border: 1px solid #ccc;
        border-radius: 10px;
        font-size: 14px;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #2196F3;
        box-shadow: 0 0 0 2px rgba(33, 150, 243, 0.1);
        outline: none;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        border: none;
        background-color: #2196F3;
        color: white;
        font-weight: 600;
        font-size: 15px;
        border-radius: 10px;
        transition: background-color 0.2s ease, transform 0.1s ease;
    }

    .btn-login:hover {
        background-color: #1976D2;
        transform: translateY(-1px);
    }

    .alert {
        margin-top: 20px;
        font-size: 14px;
        color: #b00020;
        background: #ffeaea;
        border: 1px solid #ffcccc;
        padding: 10px;
        border-radius: 6px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
            height: auto;
        }

        .image-side {
            height: 100px;
        }
    }
</style>

<div class="container">
    <div class="image-side"></div>

    <div class="login-wrapper">
        <div class="login-title">Login Admin</div>
        <div class="login-subtext">Silakan masuk untuk mengakses dashboard</div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <input type="text" name="username" class="form-control" placeholder="Nama pengguna" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Kata sandi" required>
            </div>
            <button type="submit" class="btn btn-login">Masuk</button>
        </form>

        @if ($errors->any())
            <div class="alert">
                {{ $errors->first() }}
            </div>
        @endif
    </div>
</div>
@endsection
