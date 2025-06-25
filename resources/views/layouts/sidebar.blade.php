<aside class="main-sidebar sidebar-light-primary elevation-4" style="background: linear-gradient(to bottom, #d1eaff, #ffffff);">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link text-center">
        <span class="brand-text font-weight-bold" style="color: #003366;">LITERA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">DATA</li>
                <li class="nav-item">
                    <a href="{{ route('buku.index') }}" class="nav-link {{ request()->is('buku*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Buku</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->is('kategori*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tags"></i>
                        <p>Kategori</p>
                    </a>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item">
                    <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->is('peminjaman*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>Peminjaman</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('pengembalian.index') }}" class="nav-link {{ request()->is('pengembalian*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-undo"></i>
                        <p>Pengembalian</p>
                    </a>
                </li>
                
                <li class="nav-header">MEMBER</li>

                <li class="nav-item">
                    <a href="{{ route('anggota.index') }}" class="nav-link {{ request()->is('anggota*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>Anggota</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('petugas.index') }}" class="nav-link {{ request()->is('petugas*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-shield"></i>
                        <p>Petugas</p>
                    </a>
                </li>

                

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
