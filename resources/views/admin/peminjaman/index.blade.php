@extends('layouts.master')

@section('title', 'Daftar Peminjaman')

@section('content')
<style>
    :root {
        --sidebar-bg:rgb(95, 160, 224);
        --sidebar-hover:rgb(29, 142, 255);
        --sidebar-text: #ecf0f1;
    }
    
    .sidebar {
        background-color: var(--sidebar-bg);
        color: var(--sidebar-text);
        transition: all 0.3s;
    }
    
    .sidebar .nav-link {
        color: var(--sidebar-text);
        padding: 12px 20px;
        margin: 2px 0;
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .sidebar .nav-link:hover, .sidebar .nav-link.active {
        background-color: var(--sidebar-hover);
        transform: translateX(5px);
    }
    
    .sidebar .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    
    .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .table-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 12px;
    }

    .custom-table thead th {
        background-color: #f8f9fa;
        padding: 15px 20px;
        text-align: left;
        font-weight: 600;
        font-size: 14px;
        color: #2c3e50;
        border-bottom: 2px solid #e9ecef;
    }

    .custom-table tbody tr {
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 123, 255, 0.05);
        transition: all 0.3s ease;
    }

    .custom-table tbody td {
        padding: 15px 20px;
        font-size: 14px;
        color: #495057;
        vertical-align: middle;
        border-top: 1px solid #f1f1f1;
    }

    .custom-table tbody tr:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.1);
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 6px;
        transition: all 0.2s;
    }

    .btn-sm:hover {
        transform: translateY(-1px);
    }

    .page-title {
        font-size: 28px;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 25px;
        position: relative;
        display: inline-block;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50px;
        height: 4px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
        border-radius: 2px;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
    }
    
    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 500;
    }
    
    .status-pending {
        background-color: #fff3cd;
        color: #856404;
    }
    
    .status-dikembalikan {
        background-color: #d4edda;
        color: #155724;
    }
    
    .status-dipinjam {
        background-color: #cce5ff;
        color: #004085;
    }
    
    .fade-in {
        animation: fadeIn 0.5s ease-in;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 5px;
    }
</style>

<div class="container fade-in">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title">📖 Daftar Peminjaman</h1>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Peminjaman
        </a>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Judul Buku</th>
                    <th>Peminjam</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Tenggat Waktu</th>
                    <th>Status</th>
                    <th>Tgl Kembali</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $index => $pinjam)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pinjam->buku->title }}</td>
                    <td>{{ $pinjam->user->name }}</td>
                    <td>{{ $pinjam->tanggal_peminjaman }}</td>
                    <td>{{ $pinjam->tenggat_waktu }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($pinjam->status) }}">
                            {{ ucfirst($pinjam->status) }}
                        </span>
                    </td>
                    <td>{{ $pinjam->tanggal_dikembalikan ?? '-' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>

                            @if($pinjam->status == 'pending')
                            <form action="{{ route('peminjaman.acc', $pinjam->id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Setujui">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        
        // Animasi untuk setiap baris tabel
        $('tbody tr').each(function(i) {
            $(this).delay(i * 100).animate({
                opacity: 1
            }, 200);
        });
    });
</script>
@endsection