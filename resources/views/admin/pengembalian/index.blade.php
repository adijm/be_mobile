@extends('layouts.master')

@section('content')
<div class="container">
    <h3>Daftar Pengembalian</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Buku</th>
                <th>User</th>
                <th>Tanggal Pinjam</th>
                <th>Tenggat Waktu</th>
                <th>Status</th>
                <th>Denda</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($peminjaman as $p)
            <tr>
                <td>{{ $p->buku->title }}</td>
                <td>{{ $p->user->name }}</td>
                <td>{{ $p->tanggal_peminjaman }}</td>
                <td>{{ $p->tenggat_waktu }}</td>
                <td>{{ ucfirst($p->status) }}</td>
                <td>
                    @if($p->denda)
                        Rp {{ number_format($p->denda, 0, ',', '.') }}
                    @else
                        Tidak ada
                    @endif
                </td>
                <td>
                    @if($p->status !== 'dikembalikan')
                    <form method="POST" action="{{ route('pengembalian.kembalikan', $p->id) }}">
                        @csrf
                        <button class="btn btn-success btn-sm">Kembalikan</button>
                    </form>
                    @else
                        Sudah dikembalikan
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection