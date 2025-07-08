@extends('layouts.guest')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
        --success-color: #4cc9f0;
        --error-color: #f72585;
    }
    
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        height: 100vh;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    
    .login-container {
        width: 900px;
        height: 550px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        animation: fadeIn 0.8s ease-in-out;
    }
    
    .illustration-side {
        flex: 1;
        background: linear-gradient(to bottom right, var(--primary-color), var(--secondary-color));
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .illustration-side::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }
    
    .illustration-side::after {
        content: '';
        position: absolute;
        width: 200px;
        height: 200px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        bottom: -50px;
        left: -50px;
    }
    
    .illustration-img {
        width: 100%;
        max-width: 350px;
        z-index: 2;
        animation: float 6s ease-in-out infinite;
    }
    
    .illustration-text {
        color: white;
        text-align: center;
        margin-top: 30px;
        z-index: 2;
    }
    
    .illustration-text h3 {
        font-weight: 600;
        margin-bottom: 10px;
    }
    
    .illustration-text p {
        font-weight: 300;
        font-size: 14px;
        opacity: 0.9;
    }
    
    .form-side {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .logo {
        text-align: center;
        margin-bottom: 30px;
    }
    
    .logo img {
        height: 50px;
    }
    
    .welcome-text h2 {
        color: var(--dark-color);
        font-weight: 700;
        margin-bottom: 5px;
        text-align: center;
    }
    
    .welcome-text p {
        color: #6c757d;
        font-size: 14px;
        text-align: center;
        margin-bottom: 30px;
    }
    
    .form-group {
        margin-bottom: 20px;
        position: relative;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #495057;
        font-size: 14px;
    }
    
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ced4da;
        border-radius: 10px;
        font-size: 14px;
        transition: all 0.3s;
        background-color: #f8f9fa;
    }
    
    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(72, 149, 239, 0.2);
        background-color: white;
    }
    
    .input-icon {
        position: absolute;
        right: 15px;
        top: 38px;
        color: #6c757d;
    }
    
    .btn-login {
        width: 100%;
        padding: 12px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: 10px;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }
    
    .btn-login:hover {
        background: linear-gradient(to right, var(--secondary-color), var(--primary-color));
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(67, 97, 238, 0.4);
    }
    
    .btn-login:active {
        transform: translateY(0);
    }
    
    .forgot-pass {
        text-align: right;
        margin-top: 10px;
    }
    
    .forgot-pass a {
        color: #6c757d;
        font-size: 13px;
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .forgot-pass a:hover {
        color: var(--primary-color);
    }
    
    .alert {
        margin-top: 20px;
        font-size: 14px;
        padding: 12px;
        border-radius: 8px;
        text-align: center;
    }
    
    .alert-danger {
        background-color: rgba(247, 37, 133, 0.1);
        color: var(--error-color);
        border: 1px solid rgba(247, 37, 133, 0.2);
        animation: shake 0.5s;
    }
    
    .alert-success {
        background-color: rgba(76, 201, 240, 0.1);
        color: var(--success-color);
        border: 1px solid rgba(76, 201, 240, 0.2);
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        20%, 60% { transform: translateX(-5px); }
        40%, 80% { transform: translateX(5px); }
    }
    
    /* Responsive Design */
    @media (max-width: 992px) {
        .login-container {
            width: 90%;
            height: auto;
            flex-direction: column;
        }
        
        .illustration-side {
            padding: 30px;
        }
        
        .illustration-img {
            max-width: 250px;
        }
        
        .form-side {
            padding: 30px;
        }
    }
    
    @media (max-width: 576px) {
        .login-container {
            border-radius: 10px;
        }
        
        .illustration-side {
            display: none;
        }
        
        .form-side {
            padding: 25px;
        }
    }
</style>

<div class="login-container">
    <div class="illustration-side">
        <img src="https://cdn-icons-png.flaticon.com/512/3583/3583158.png" alt="Library Illustration" class="illustration-img">
        <div class="illustration-text">
            <h3>Sistem Administrasi Perpustakaan</h3>
            <p>Kelola koleksi buku, anggota, dan peminjaman dengan mudah</p>
        </div>
    </div>
    
    <div class="form-side">
        <div class="logo">
            <img src="https://via.placeholder.com/150x50?text=Perpustakaan" alt="Logo Perpustakaan">
        </div>
        
        <div class="welcome-text">
            <h2>Selamat Datang Kembali</h2>
            <p>Silakan masuk ke akun admin Anda</p>
        </div>
        
        <form action="{{ route('login.process') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required>
                <i class="fas fa-user input-icon"></i>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required>
                <i class="fas fa-lock input-icon"></i>
            </div>
            
            <div class="forgot-pass">
                <a href="#">Lupa password?</a>
            </div>
            
            <button type="submit" class="btn-login">
                <span class="mr-2">Masuk</span>
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
        
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <i class="fas fa-exclamation-circle mr-2"></i>
                {{ $errors->first() }}
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle mr-2"></i>
                {{ session('success') }}
            </div>
        @endif
    </div>
</div>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- Include jQuery and Bootstrap JS for animations -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Add animation to form elements
    $(document).ready(function() {
        $('.form-group').each(function(i) {
            $(this).delay(i * 200).animate({
                opacity: 1,
                marginTop: 0
            }, 400);
        });
        
        // Add hover effect to input fields
        $('.form-control').hover(
            function() {
                $(this).css('border-color', 'var(--accent-color)');
            },
            function() {
                if (!$(this).is(':focus')) {
                    $(this).css('border-color', '#ced4da');
                }
            }
        );
    });
</script>
@endsection