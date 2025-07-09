@extends('layouts.master')

@section('title', 'Daftar Pengembalian')

@section('content')
<style>
    /* Reuse the same style from peminjaman for consistency */
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
        margin-bottom: 2rem;
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

    .status-dikembalikan {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-belum {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
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

    .btn-sm:hover {
        transform: translateY(-2px);
    }

    .btn-outline-success {
        border-color: #2ecc71;
        color: #2ecc71;
    }

    .btn-outline-success:hover {
        background-color: #2ecc71;
        color: #fff;
    }

    .text-muted {
        color: #6c757d !important;
        font-style: italic;
        font-weight: 600;
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
    }
</style>

<div class="container">
    <div class="page-header">
        <h1 class="page-title">📥 Daftar Pengembalian</h1>
    </div>

    <div class="table-container" role="region" aria-label="Tabel daftar pengembalian buku">
        <table class="custom-table" role="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Judul Buku</th>
                    <th scope="col">User</th>
                    <th scope="col">Tanggal Pinjam</th>
                    <th scope="col">Tenggat Waktu</th>
                    <th scope="col">Status</th>
                    <th scope="col">Denda</th>
                    <th scope="col" style="min-width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->buku->title }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tanggal_peminjaman)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($p->tenggat_waktu)->format('d M Y') }}</td>
                    <td>
                        <span class="status-badge status-{{ $p->status === 'dikembalikan' ? 'dikembalikan' : 'belum' }}">
                            {{ ucfirst($p->status) }}
                        </span>
                    </td>
                    <td>
                        @if($p->denda && $p->denda > 0)
                            Rp {{ number_format($p->denda, 0, ',', '.') }}
                        @else
                            Tidak ada
                        @endif
                    </td>
                    <td>
                        <div class="action-buttons" role="group" aria-label="Aksi pengembalian {{ $p->buku->title }}">
                            @if($p->status !== 'dikembalikan')
                            <form method="POST" action="{{ route('pengembalian.kembalikan', $p->id) }}">
                                @csrf
                                <button class="btn btn-sm btn-outline-success" type="submit" aria-label="Kembalikan buku {{ $p->buku->title }}">
                                    <i class="fas fa-undo"></i> Kembalikan
                                </button>
                            </form>
                            @else
                                <span class="text-muted" aria-label="Selesai dikembalikan">✔ Selesai</span>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

@endsection
