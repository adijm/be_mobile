@extends('layouts.master')

@section('title', 'Daftar Peminjaman')

@section('content')
<style>
    :root {
        --sidebar-bg: rgb(211, 238, 243);
        --sidebar-hover: rgb(250, 252, 255);
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

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background-color: var(--sidebar-hover);
        transform: translateX(5px);
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }

    .container {
        max-width: 1200px;
        margin: 2rem auto 4rem;
        padding: 0 1rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #2c3e50;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        position: relative;
        color: #2c3e50;
        margin: 0;
        white-space: nowrap;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, #3498db, #2ecc71);
        border-radius: 2px;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 10px 22px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s, transform 0.3s, box-shadow 0.3s;
        cursor: pointer;
        white-space: nowrap;
    }

    .btn-primary:hover,
    .btn-primary:focus {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(52, 152, 219, 0.4);
        outline: none;
    }

    .table-container {
        background-color: #ffffff;
        border-radius: 16px;
        padding: 25px 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow-x: auto;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .table-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
    }

    table.custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
        font-size: 14px;
        min-width: 900px;
    }

    thead.custom-table th {
        background-color: #f8f9fa;
        padding: 16px 20px;
        text-align: left;
        font-weight: 700;
        font-size: 15px;
        color: #34495e;
        border-bottom: 3px solid #e9ecef;
        white-space: nowrap;
    }

    tbody.custom-table tr {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 12px rgba(0, 123, 255, 0.07);
        transition: all 0.25s ease;
    }

    tbody.custom-table tr:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 123, 255, 0.15);
    }

    tbody.custom-table td {
        padding: 16px 20px;
        vertical-align: middle;
        color: #495057;
        border-top: 1px solid #f1f1f1;
        white-space: nowrap;
    }

    tbody.custom-table td:first-child {
        width: 40px;
        font-weight: 600;
        color: #2980b9;
    }

    /* Status badges */
    .status-badge {
        display: inline-block;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        text-transform: capitalize;
        user-select: none;
    }

    .status-pending {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
    }

    .status-dikembalikan {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-dipinjam {
        background-color: #cce5ff;
        color: #004085;
        border: 1px solid #b8daff;
    }

    /* Action buttons container */
    .action-buttons {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        justify-content: center;
        align-items: center;
    }

    .action-buttons form,
    .action-buttons a {
        margin: 0;
    }

    .btn-sm {
        padding: 6px 12px;
        font-size: 13px;
        border-radius: 6px;
        border: 1.5px solid transparent;
        background: none;
        color: #34495e;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .btn-sm i {
        pointer-events: none;
    }

    .btn-sm:hover {
        transform: translateY(-2px);
    }

    .btn-outline-warning {
        border-color: #f1c40f;
        color: #f1c40f;
    }

    .btn-outline-warning:hover {
        background-color: #f1c40f;
        color: #fff;
    }

    .btn-outline-danger {
        border-color: #e74c3c;
        color: #e74c3c;
    }

    .btn-outline-danger:hover {
        background-color: #e74c3c;
        color: #fff;
    }

    .btn-outline-success {
        border-color: #2ecc71;
        color: #2ecc71;
    }

    .btn-outline-success:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .container {
            padding: 0 1rem;
        }

        table.custom-table {
            min-width: 700px;
        }
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-primary {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">📖 Daftar Peminjaman</h1>
        <a href="{{ route('peminjaman.create') }}" class="btn btn-primary" aria-label="Tambah Peminjaman">
            <i class="fas fa-plus"></i> Tambah Peminjaman
        </a>
    </div>

    <div class="table-container" role="region" aria-label="Tabel daftar peminjaman buku">
        <table class="custom-table" role="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">Peminjam</th>
                    <th scope="col">Tanggal Peminjaman</th>
                    <th scope="col">Tenggat Waktu</th>
                    <th scope="col">Status</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col" style="min-width: 140px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $index => $pinjam)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $pinjam->buku->title }}</td>
                    <td>{{ $pinjam->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->tanggal_peminjaman)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pinjam->tenggat_waktu)->format('d M Y') }}</td>
                    <td>
                        <span class="status-badge status-{{ strtolower($pinjam->status) }}">
                            {{ ucfirst($pinjam->status) }}
                        </span>
                    </td>
                    <td>{{ $pinjam->tanggal_dikembalikan ? \Carbon\Carbon::parse($pinjam->tanggal_dikembalikan)->format('d M Y') : '-' }}</td>
                    <td>
                        <div class="action-buttons" role="group" aria-label="Aksi peminjaman {{ $pinjam->buku->title }}">
                            <a href="{{ route('peminjaman.edit', $pinjam->id) }}" class="btn btn-sm btn-outline-warning" data-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit" aria-hidden="true"></i>
                                <span class="sr-only">Edit Peminjaman</span>
                            </a>

                            <form action="{{ route('peminjaman.destroy', $pinjam->id) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash" aria-hidden="true"></i>
                                    <span class="sr-only">Hapus Peminjaman</span>
                                </button>
                            </form>

                            @if($pinjam->status == 'pending')
                            <form action="{{ route('peminjaman.acc', $pinjam->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success" data-toggle="tooltip" title="Setujui">
                                    <i class="fas fa-check" aria-hidden="true"></i>
                                    <span class="sr-only">Setujui Peminjaman</span>
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
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
@endsection
