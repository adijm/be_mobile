@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="row">

  <!-- Box Jumlah Anggota -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-info">
      <div class="inner">
        <h3>{{ $jumlahAnggota }}</h3>
        <p>Anggota</p>
      </div>
      <div class="icon"><i class="fas fa-users"></i></div>
      <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Box Jumlah Buku -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-success">
      <div class="inner">
        <h3>{{ $jumlahBuku }}</h3>
        <p>Total Buku</p>
      </div>
      <div class="icon"><i class="fas fa-book"></i></div>
      <a href="{{ route('buku.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Box Jumlah Transaksi -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-primary">
      <div class="inner">
        <h3>{{ $jumlahTransaksi }}</h3>
        <p>Total Transaksi</p>
      </div>
      <div class="icon"><i class="fas fa-exchange-alt"></i></div>
      <a href="{{ route('peminjaman.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

  <!-- Box Transaksi Pending -->
  <div class="col-lg-3 col-6">
    <div class="small-box bg-warning">
      <div class="inner">
        <h3>{{ $jumlahPending }}</h3>
        <p>Transaksi Pending</p>
      </div>
      <div class="icon"><i class="fas fa-exclamation-triangle"></i></div>
      <a href="{{ route('peminjaman.index') }}" class="small-box-footer">Cek Sekarang <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>

</div>
@endsection
