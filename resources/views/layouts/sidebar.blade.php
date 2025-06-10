<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
      <span class="brand-text font-weight-light">LITERA</span>
    </a>
  
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
          <!-- Dashboard -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
  
          <li class="nav-header">DATA</li>
  
          <!-- Dropdown Menu Buku -->
          <li class="nav-item has-treeview {{ request()->routeIs('buku.*') || request()->routeIs('kategori.*') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('buku.*') || request()->routeIs('kategori.*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Buku
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Buku</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('kategori.index') }}" class="nav-link {{ request()->routeIs('kategori.index') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Kategori</p>
                </a>
              </li>
            </li>
             





            </ul>
               <!-- Di dalam <ul class="nav nav-pills nav-sidebar flex-column" ...> -->

<li class="nav-header">TRANSAKSI</li>

<li class="nav-item has-treeview {{ request()->routeIs('peminjaman.*') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}">
    <i class="nav-icon fas fa-hand-holding"></i>
    <p>
      Peminjaman
      <i class="right fas fa-angle-left"></i>
    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('peminjaman.index') }}" class="nav-link {{ request()->routeIs('peminjaman.index') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>List Peminjaman</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('peminjaman.create') }}" class="nav-link {{ request()->routeIs('peminjaman.create') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Tambah Peminjaman</p>
      </a>
    </li>
  </ul>
</li>
<!-- Menu Pengembalian -->
<li class="nav-item">
  <a href="{{ route('pengembalian.index') }}" class="nav-link {{ request()->routeIs('pengembalian.index') ? 'active' : '' }}">
    <i class="nav-icon fas fa-undo-alt"></i>
    <p>Pengembalian</p>
  </a>
</li>
</ul>
</li>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
