<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin | @yield('title')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}" />

    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Navbar (bisa ditambah kalau ada) --}}
      

        {{-- Content Wrapper --}}
        <div class="content-wrapper">
            <section class="content p-3">
                @yield('content')
            </section>
        </div>

        {{-- Footer (optional) --}}
        <footer class="main-footer text-center p-2">
            <strong>&copy; {{ date('Y') }} LITERA.</strong> All rights reserved.
        </footer>
    </div>
</body>
</html>
