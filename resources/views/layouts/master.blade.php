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
      --primary-color: #6c5ce7;
      --secondary-color: #a29bfe;
      --accent-color: #fd79a8;
      --dark-color: #2d3436;
      --light-color: #f5f6fa;
      --success-color: #00b894;
      --warning-color: #fdcb6e;
      --danger-color: #d63031;
      --glass-bg: rgba(255, 255, 255, 0.85);
      --sidebar-width: 280px;
    }
    
    body {
      background: linear-gradient(135deg, #f5f7fa 0%, #dfe6e9 100%);
      font-family: 'Poppins', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      color: var(--dark-color);
    }
    
    /* Floating particles */
    .particles {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
    }
    
    .particle {
      position: absolute;
      background: rgba(108, 92, 231, 0.1);
      border-radius: 50%;
      filter: blur(5px);
      animation: floatParticle linear infinite;
    }
    
    @keyframes floatParticle {
      0% {
        transform: translateY(0) rotate(0deg);
        opacity: 1;
      }
      100% {
        transform: translateY(-100vh) rotate(360deg);
        opacity: 0;
      }
    }
    
    /* Glass morphism effect */
    .glass-card {
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    
    .glass-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
    }
    
    /* Sidebar styling */
    .main-sidebar {
      background: linear-gradient(135deg, var(--dark-color) 0%, #3d3d3d 100%);
      color: white;
      box-shadow: 8px 0 25px rgba(0, 0, 0, 0.1);
      transition: all 0.4s ease;
      width: var(--sidebar-width);
    }
    
    .brand-link {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding: 1.5rem 1rem;
      text-align: center;
      background: rgba(0, 0, 0, 0.2);
    }
    
    .brand-text {
      font-weight: 600;
      letter-spacing: 1px;
      font-size: 1.3rem;
      background: linear-gradient(to right, #fff, var(--secondary-color));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .nav-sidebar .nav-link {
      color: rgba(255, 255, 255, 0.8);
      margin: 0.3rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
      padding: 0.75rem 1rem;
      position: relative;
      overflow: hidden;
    }
    
    .nav-sidebar .nav-link:before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
      transition: all 0.6s ease;
    }
    
    .nav-sidebar .nav-link:hover {
      color: white;
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateX(8px);
    }
    
    .nav-sidebar .nav-link:hover:before {
      left: 100%;
    }
    
    .nav-sidebar .nav-link.active {
      color: white;
      background: linear-gradient(90deg, rgba(108, 92, 231, 0.3), rgba(108, 92, 231, 0.1));
      font-weight: 500;
      transform: translateX(8px);
      box-shadow: inset 4px 0 0 var(--primary-color);
    }
    
    .nav-sidebar .nav-link i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
      font-size: 1.1rem;
    }
    
    /* Content area */
    .content-wrapper {
      background-color: transparent;
      min-height: calc(100vh - 3.5rem);
      margin-left: var(--sidebar-width);
      transition: all 0.4s ease;
    }
    
    /* Main content */
    .main-content {
      padding: 2rem;
      animation: fadeIn 0.6s ease-out;
    }
    
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Page header */
    .page-header {
      margin-bottom: 2rem;
      position: relative;
    }
    
    .page-title {
      font-size: 2.2rem;
      font-weight: 700;
      color: var(--dark-color);
      margin-bottom: 0.5rem;
      position: relative;
      display: inline-block;
    }
    
    .page-title:after {
      content: '';
      position: absolute;
      bottom: -8px;
      left: 0;
      width: 60px;
      height: 4px;
      background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
      border-radius: 2px;
    }
    
    /* Buttons */
    .btn {
      border-radius: 8px;
      padding: 0.6rem 1.2rem;
      font-weight: 500;
      letter-spacing: 0.5px;
      transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
      border: none;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      background-image: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    }
    
    .btn-primary:hover {
      background-image: linear-gradient(135deg, var(--primary-color) 0%, #8c7ae6 100%);
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(108, 92, 231, 0.4);
    }
    
    .btn-success {
      background-color: var(--success-color);
    }
    
    .btn-warning {
      background-color: var(--warning-color);
      color: var(--dark-color);
    }
    
    .btn-danger {
      background-color: var(--danger-color);
    }
    
    /* Tables */
    .custom-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0 12px;
    }
    
    .custom-table thead th {
      background-color: rgba(108, 92, 231, 0.1);
      padding: 1rem 1.5rem;
      text-align: left;
      font-weight: 600;
      font-size: 0.9rem;
      color: var(--dark-color);
      border: none;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    
    .custom-table tbody tr {
      background: var(--glass-bg);
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
      transition: all 0.3s ease;
    }
    
    .custom-table tbody td {
      padding: 1.2rem 1.5rem;
      font-size: 0.95rem;
      color: var(--dark-color);
      vertical-align: middle;
      border-top: 1px solid rgba(0, 0, 0, 0.03);
      border-bottom: 1px solid rgba(0, 0, 0, 0.03);
    }
    
    .custom-table tbody tr:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }
    
    .custom-table tbody tr:first-child td:first-child {
      border-radius: 12px 0 0 12px;
    }
    
    .custom-table tbody tr:first-child td:last-child {
      border-radius: 0 12px 12px 0;
    }
    
    /* Status badges */
    .status-badge {
      padding: 0.5rem 0.8rem;
      border-radius: 50px;
      font-size: 0.8rem;
      font-weight: 600;
      display: inline-block;
      min-width: 100px;
      text-align: center;
    }
    
    .status-pending {
      background-color: rgba(253, 203, 110, 0.2);
      color: #e17055;
    }
    
    .status-dipinjam {
      background-color: rgba(108, 92, 231, 0.2);
      color: var(--primary-color);
    }
    
    .status-dikembalikan {
      background-color: rgba(0, 184, 148, 0.2);
      color: var(--success-color);
    }
    
    /* Action buttons */
    .action-buttons {
      display: flex;
      gap: 0.5rem;
      flex-wrap: wrap;
    }
    
    .action-btn {
      width: 36px;
      height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    
    .action-btn:hover {
      transform: scale(1.1);
    }
    
    /* Footer */
    .main-footer {
      background-color: transparent;
      border-top: none;
      color: #6c757d;
      padding: 1.5rem;
      text-align: center;
      font-size: 0.9rem;
    }
    
    /* Responsive adjustments */
    @media (max-width: 992px) {
      .main-sidebar {
        transform: translateX(-100%);
        position: fixed;
        z-index: 1050;
        height: 100vh;
      }
      
      .main-sidebar.active {
        transform: translateX(0);
      }
      
      .content-wrapper {
        margin-left: 0;
      }
      
      .sidebar-toggle {
        display: flex !important;
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
      padding: 0.8rem;
      z-index: 1100;
      display: none;
      box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
      transition: all 0.3s ease;
      align-items: center;
      justify-content: center;
    }
    
    .sidebar-toggle:hover {
      transform: scale(1.1);
    }
    
    /* Floating action button */
    .fab {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.5rem;
      box-shadow: 0 6px 20px rgba(108, 92, 231, 0.3);
      transition: all 0.3s ease;
      z-index: 1000;
      animation: pulse 2s infinite;
    }
    
    .fab:hover {
      transform: scale(1.1) rotate(90deg);
      box-shadow: 0 8px 25px rgba(108, 92, 231, 0.4);
    }
    
    @keyframes pulse {
      0% {
        box-shadow: 0 0 0 0 rgba(108, 92, 231, 0.4);
      }
      70% {
        box-shadow: 0 0 0 15px rgba(108, 92, 231, 0);
      }
      100% {
        box-shadow: 0 0 0 0 rgba(108, 92, 231, 0);
      }
    }
    
    /* Form elements */
    .form-control {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      border: 1px solid rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }
    
    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.25rem rgba(108, 92, 231, 0.25);
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: rgba(0, 0, 0, 0.05);
    }
    
    ::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: var(--secondary-color);
    }
  </style>
  
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini">
  <!-- Floating particles background -->
  <div class="particles" id="particles"></div>

  <!-- Sidebar Toggle Button (mobile) -->
  <button class="sidebar-toggle animate__animated animate__fadeIn" id="sidebarToggle">
    <i class="fas fa-bars"></i>
  </button>

  <!-- Floating Action Button -->
  <a href="{{ route('peminjaman.create') }}" class="fab animate__animated animate__bounceIn">
    <i class="fas fa-plus"></i>
  </a>

  <div class="wrapper">
    <!-- Navbar -->
    @include('layouts.navbar')
    
    <!-- Sidebar -->
    @include('layouts.sidebar')
    
    <!-- Content Wrapper -->
    <div class="content-wrapper">
      <div class="main-content">
        @yield('content')
      </div>
    </div>
    
    <!-- Footer -->
    <footer class="main-footer animate__animated animate__fadeInUp">
      <div class="container">
        <div class="row">
          <div class="col-12 text-center">
            <p class="mb-0">© {{ date('Y') }} Perpustakaan Digital. All rights reserved.</p>
            <div class="social-links mt-2">
              <a href="#" class="text-secondary mx-2"><i class="fab fa-facebook-f"></i></a>
              <a href="#" class="text-secondary mx-2"><i class="fab fa-twitter"></i></a>
              <a href="#" class="text-secondary mx-2"><i class="fab fa-instagram"></i></a>
              <a href="#" class="text-secondary mx-2"><i class="fab fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>
      </div>
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
      
      // Create floating particles
      function createParticles() {
        const particlesContainer = document.getElementById('particles');
        const particleCount = window.innerWidth < 768 ? 20 : 50;
        
        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement('div');
          particle.classList.add('particle');
          
          // Random properties
          const size = Math.random() * 20 + 5;
          const posX = Math.random() * window.innerWidth;
          const posY = Math.random() * window.innerHeight;
          const duration = Math.random() * 20 + 10;
          const delay = Math.random() * 10;
          
          particle.style.width = `${size}px`;
          particle.style.height = `${size}px`;
          particle.style.left = `${posX}px`;
          particle.style.top = `${posY}px`;
          particle.style.animationDuration = `${duration}s`;
          particle.style.animationDelay = `${delay}s`;
          
          particlesContainer.appendChild(particle);
        }
      }
      
      createParticles();
      
      // Scroll animation
      const animateOnScroll = function() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        
        elements.forEach(element => {
          const elementPosition = element.getBoundingClientRect().top;
          const windowHeight = window.innerHeight;
          
          if (elementPosition < windowHeight - 100) {
            element.classList.add('animate__animated', 'animate__fadeInUp');
          }
        });
      };
      
      window.addEventListener('scroll', animateOnScroll);
      animateOnScroll(); // Initialize
      
      // Tooltip initialization
      $('[data-bs-toggle="tooltip"]').tooltip({
        trigger: 'hover',
        animation: true
      });
    });
  </script>
  
  @stack('scripts')
</body>
</html>