<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Perpustakaan')</title>
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    body {
      background: linear-gradient(to bottom right, #e6f3ff, #ffffff);
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .content-wrapper {
      background: linear-gradient(to bottom right, #e6f3ff, #ffffff);
      min-height: 100vh;
    }

    .main-footer {
      background-color: transparent;
      border-top: none;
    }

    body::before, body::after {
      content: "";
      position: fixed;
      border-radius: 50%;
      z-index: -1;
      opacity: 0.15;
    }

    body::before {
      width: 400px;
      height: 400px;
      background: #cce9ff;
      top: -100px;
      left: -100px;
    }

    body::after {
      width: 400px;
      height: 400px;
      background: #cce9ff;
      bottom: -100px;
      right: -100px;
    }

    /* Sidebar */
    .main-sidebar {
      background: linear-gradient(to bottom right, #d1eaff, #cce0ff);
    }

    .main-sidebar .brand-link,
    .main-sidebar .nav-link,
    .main-sidebar .nav-header {
      color: #000 !important; /* Ubah semua teks sidebar jadi hitam */
    }

    .main-sidebar .nav-link.active {
      background-color: #3399ff !important;
      color: white !important;
      border-radius: 8px;
    }

    .main-sidebar .nav-link:hover {
      background-color: #b3ddff;
      color: #000;
    }

    .btn-primary {
      background: #3399ff;
      border: none;
    }

    .btn-primary:hover {
      background: #007bff;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  @include('layouts.navbar')
  @include('layouts.sidebar')

  <div class="content-wrapper p-3">
    @yield('content')
  </div>

  <footer class="main-footer text-center">
    <small>Copyright &copy; {{ date('Y') }} Sistem Informasi Perpustakaan</small>
  </footer>
</div>

<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('#bukuSelect, #userSelect').select2({
            placeholder: "Cari dan pilih...",
            allowClear: true
        });
    });
</script>

</body>
</html>