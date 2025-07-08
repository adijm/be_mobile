<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Perpustakaan Digital')</title>
  
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  
  <!-- Select2 -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color:rgb(243, 57, 181);
      --secondary-color: #3f37c9;
      --accent-color: #4895ef;
      --light-blue: #e6f3ff;
    }
    
    body {
      background: linear-gradient(to bottom right, var(--light-blue), #ffffff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }
    
    /* Floating background elements */
    .bg-circle {
      position: fixed;
      border-radius: 50%;
      background: radial-gradient(circle, rgba(67, 97, 238, 0.1) 0%, rgba(67, 97, 238, 0) 70%);
      z-index: -1;
      animation: float 15s infinite linear;
    }
    
    .circle-1 {
      width: 300px;
      height: 300px;
      top: -50px;
      left: -50px;
      animation-delay: 0s;
    }
    
    .circle-2 {
      width: 200px;
      height: 200px;
      bottom: -30px;
      right: -30px;
      animation-delay: 3s;
    }
    
    .circle-3 {
      width: 150px;
      height: 150px;
      top: 30%;
      right: 10%;
      animation-delay: 6s;
    }
    
    /* Main wrapper */
    .wrapper {
      position: relative;
      overflow: hidden;
    }
    
    /* Sidebar styling */
    .main-sidebar {
      background: linear-gradient(to bottom, var(--primary-color), var(--secondary-color));
      color: white;
      box-shadow: 5px 0 15px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .brand-link {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .nav-sidebar .nav-link {
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 5px;
      border-radius: 5px;
      transition: all 0.3s ease;
    }
    
    .nav-sidebar .nav-link:hover {
      color: white;
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateX(5px);
    }
    
    .nav-sidebar .nav-link.active {
      color: white;
      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 500;
      transform: translateX(5px);
    }
    
    .nav-sidebar .nav-link i {
      margin-right: 10px;
    }
    
    /* Content area */
    .content-wrapper {
      background-color: transparent;
      min-height: calc(100vh - 3.5rem);
    }
    
    /* Cards */
    .card {
      border: none;
      border-radius: 12px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
      margin-bottom: 20px;
      overflow: hidden;
    }
    
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
    }
    
    .card-header {
      background-color: white;
      border-bottom: 1px solid rgba(0, 0, 0, 0.05);
      font-weight: 600;
      border-radius: 12px 12px 0 0 !important;
    }
    
    /* Buttons */
    .btn-primary {
      background-color: var(--accent-color);
      border-color: var(--accent-color);
    }
    
    .btn-primary:hover {
      background-color: #3a56e8;
      border-color: #3a56e8;
    }
    
    /* Animations */
    @keyframes float {
      0% {
        transform: translate(0, 0) rotate(0deg);
      }
      25% {
        transform: translate(10px, 10px) rotate(5deg);
      }
      50% {
        transform: translate(20px, 5px) rotate(0deg);
      }
      75% {
        transform: translate(10px, 15px) rotate(-5deg);
      }
      100% {
        transform: translate(0, 0) rotate(0deg);
      }
    }
    
    .animate-on-scroll {
      opacity: 0;
      transform: translateY(20px);
      transition: opacity 0.6s ease, transform 0.6s ease;
    }
    
    .animate-on-scroll.visible {
      opacity: 1;
      transform: translateY(0);
    }
    
    /* Footer */
    .main-footer {
      background-color: transparent;
      border-top: none;
      color: #6c757d;
      padding: 1rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
      .main-sidebar {
        transform: translateX(-100%);
      }
      
      .main-sidebar.active {
        transform: translateX(0);
      }
      
      .sidebar-toggle {
        display: block !important;
      }
    }
    
    .sidebar-toggle {
      position: fixed;
      top: 20px;
      left: 20px;
      background: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 10px;
      z-index: 1100;
      display: none;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
  </style>
  
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
  <!-- Floating background circles -->
  <div class="bg-circle circle-1"></div>
  <div class="bg-circle circle-2"></div>
  <div class="bg-circle circle-3"></div>

  <!-- Sidebar Toggle Button (mobile) -->
  <button class="sidebar-toggle animate__animated animate__fadeIn" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>

  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.navbar')
    
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Content Wrapper -->
    <div class="content-wrapper p-3">
      @yield('content')
    </div>
    
    <!-- Footer -->
    <footer class="main-footer text-center animate__animated animate__fadeInUp">
      <small>Copyright &copy; {{ date('Y') }} Perpustakaan Digital. All rights reserved.</small>
    </footer>
  </div>

  <!-- jQuery -->
  <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
  
  <!-- Bootstrap 5 JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  
  <!-- AdminLTE App -->
  <script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
  
  <!-- Select2 -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  
  <!-- Custom JS -->
  <script>
    $(document).ready(function() {
      // Initialize Select2
      $('#bukuSelect, #userSelect').select2({
        placeholder: "Cari dan pilih...",
        allowClear: true
      });
      
      // Sidebar toggle for mobile
      $('#sidebarToggle').click(function() {
        $('.main-sidebar').toggleClass('active');
      });
      
      // Scroll animation
      const animateElements = document.querySelectorAll('.animate-on-scroll');
      
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.classList.add('visible');
          }
        });
      }, {
        threshold: 0.1
      });
      
      animateElements.forEach(el => observer.observe(el));
    });
  </script>
  
  @stack('scripts')
</body>
</html>