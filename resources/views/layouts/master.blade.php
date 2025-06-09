<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Perpustakaan')</title>
  <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
        $('#bukuSelect').select2({
            placeholder: "Cari dan pilih buku...",
            allowClear: true
        });
    });
</script>
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
