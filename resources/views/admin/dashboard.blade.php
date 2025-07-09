
@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<!-- CSS Tambahan -->
<style>
    /* Base layout styles */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
        overflow: hidden; /* Prevent whole page scrolling */
    }

    /* Content container with scrolling */
    .content-container {
        height: calc(100vh - 60px); /* Adjust based on your header height */
        overflow: auto; /* Both horizontal and vertical scrolling */
        padding: 20px;
        background-color: #f8f9fa;
    }

    /* Content wrapper that can expand */
    .content-wrapper {
        min-width: fit-content;
        min-height: fit-content;
    }

    /* Your existing dashboard styles (unchanged) */
    :root {
        --primary-color: #4361ee;
        --secondary-color: #3f37c9;
        --accent-color: #4895ef;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }
    
    .dashboard-card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
        overflow: hidden;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
    
    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }
    
    .card-bg-1 {
        background: linear-gradient(135deg, #3498db, #2980b9);
        color: white;
    }
    
    .card-bg-2 {
        background: linear-gradient(135deg, #2ecc71, #27ae60);
        color: white;
    }
    
    .card-bg-3 {
        background: linear-gradient(135deg, #9b59b6, #8e44ad);
        color: white;
    }
    
    .card-bg-4 {
        background: linear-gradient(135deg, #f39c12, #e67e22);
        color: white;
    }
    
    .card-icon {
        font-size: 40px;
        opacity: 0.3;
        position: absolute;
        right: 20px;
        top: 20px;
    }
    
    .chart-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        padding: 20px;
        margin-bottom: 20px;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
    
    .recent-activity {
        background: white;
        border-radius: 12px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        padding: 20px;
        animation: fadeInUp 0.5s ease forwards;
        opacity: 0;
    }
    
    .activity-item {
        padding: 10px 0;
        border-bottom: 1px solid #eee;
        display: flex;
        align-items: center;
    }
    
    .activity-item:last-child {
        border-bottom: none;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 18px;
    }
    
    .bg-icon-blue {
        background-color: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }
    
    .bg-icon-green {
        background-color: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
    }
    
    .bg-icon-purple {
        background-color: rgba(155, 89, 182, 0.2);
        color: #9b59b6;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .delay-1 {
        animation-delay: 0.2s;
    }
    
    .delay-2 {
        animation-delay: 0.4s;
    }
    
    .delay-3 {
        animation-delay: 0.6s;
    }
    
    .delay-4 {
        animation-delay: 0.8s;
    }
</style>

<!-- Scrollable Content Area -->
<div class="content-container">
    <div class="content-wrapper">
        <div class="row">
            <!-- Box Jumlah Anggota -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card card-bg-1" style="animation-delay: 0.1s;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-white-50">Anggota</h5>
                                <h2 class="mb-0 text-white">{{ $jumlahAnggota }}</h2>
                            </div>
                            <i class="fas fa-users card-icon"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="text-white d-block mt-3">
                            Lihat detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Box Jumlah Buku -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card card-bg-2 delay-1">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-white-50">Total Buku</h5>
                                <h2 class="mb-0 text-white">{{ $jumlahBuku }}</h2>
                            </div>
                            <i class="fas fa-book card-icon"></i>
                        </div>
                        <a href="{{ route('buku.index') }}" class="text-white d-block mt-3">
                            Lihat detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Box Jumlah Transaksi -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card card-bg-3 delay-2">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-white-50">Total Transaksi</h5>
                                <h2 class="mb-0 text-white">{{ $jumlahTransaksi }}</h2>
                            </div>
                            <i class="fas fa-exchange-alt card-icon"></i>
                        </div>
                        <a href="{{ route('peminjaman.index') }}" class="text-white d-block mt-3">
                            Lihat detail <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Box Transaksi Pending -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="dashboard-card card-bg-4 delay-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-white-50">Transaksi Pending</h5>
                                <h2 class="mb-0 text-white">{{ $jumlahPending }}</h2>
                            </div>
                            <i class="fas fa-exclamation-triangle card-icon"></i>
                        </div>
                        <a href="{{ route('peminjaman.index') }}" class="text-white d-block mt-3">
                            Cek sekarang <i class="fas fa-arrow-circle-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Grafik Peminjaman Bulanan -->
            <div class="col-lg-8 mb-4">
                <div class="chart-container delay-1">
                    <h5 class="mb-4"><i class="fas fa-chart-line me-2"></i>Statistik Peminjaman Bulanan</h5>
                    <canvas id="monthlyChart" height="250"></canvas>
                </div>
            </div>

            <!-- Kategori Buku Populer -->
            <div class="col-lg-4 mb-4">
                <div class="chart-container delay-2">
                    <h5 class="mb-4"><i class="fas fa-bookmark me-2"></i>Kategori Buku Populer</h5>
                    <canvas id="categoryChart" height="250"></canvas>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Aktivitas Terkini -->
            <div class="col-lg-6 mb-4">
                <div class="recent-activity delay-3">
                    <h5 class="mb-4"><i class="fas fa-history me-2"></i>Aktivitas Terkini</h5>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-blue">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Buku baru ditambahkan</h6>
                            <p class="mb-0 text-muted small">"Pemrograman Web Modern" - 5 menit yang lalu</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-green">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Anggota baru bergabung</h6>
                            <p class="mb-0 text-muted small">Andi Setiawan - 1 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-purple">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Peminjaman buku</h6>
                            <p class="mb-0 text-muted small">"Struktur Data" oleh Budi Santoso - 3 jam yang lalu</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-blue">
                            <i class="fas fa-book"></i>
                        </div>
                        <div>
                            <h6 class="mb-1">Pengembalian buku</h6>
                            <p class="mb-0 text-muted small">"Algoritma dan Pemrograman" oleh Siti Rahayu - 5 jam yang lalu</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-link ps-0 mt-2">Lihat semua aktivitas</a>
                </div>
            </div>

            <!-- Buku Paling Sering Dipinjam -->
            <div class="col-lg-6 mb-4">
                <div class="recent-activity delay-4">
                    <h5 class="mb-4"><i class="fas fa-star me-2"></i>Buku Paling Sering Dipinjam</h5>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-blue">
                            <span>1</span>
                        </div>
                        <div>
                            <h6 class="mb-1">Pemrograman Web Modern</h6>
                            <p class="mb-0 text-muted small">John Doe - 45 kali dipinjam</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-green">
                            <span>2</span>
                        </div>
                        <div>
                            <h6 class="mb-1">Struktur Data dan Algoritma</h6>
                            <p class="mb-0 text-muted small">Jane Smith - 38 kali dipinjam</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-purple">
                            <span>3</span>
                        </div>
                        <div>
                            <h6 class="mb-1">Basis Data untuk Pemula</h6>
                            <p class="mb-0 text-muted small">Robert Johnson - 32 kali dipinjam</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon bg-icon-blue">
                            <span>4</span>
                        </div>
                        <div>
                            <h6 class="mb-1">Jaringan Komputer</h6>
                            <p class="mb-0 text-muted small">Sarah Williams - 28 kali dipinjam</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-link ps-0 mt-2">Lihat semua buku</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Animasi saat scroll
    document.addEventListener('DOMContentLoaded', function() {
        const animateElements = document.querySelectorAll('.dashboard-card, .chart-container, .recent-activity');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });
        
        animateElements.forEach(el => observer.observe(el));
        
        // Grafik Peminjaman Bulanan
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Peminjaman',
                    data: [120, 190, 170, 220, 250, 280, 210, 230, 300, 280, 320, 350],
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderColor: 'rgba(67, 97, 238, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Grafik Kategori Buku
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: ['Teknologi', 'Sains', 'Sejarah', 'Sastra', 'Bisnis', 'Lainnya'],
                datasets: [{
                    data: [35, 20, 15, 10, 12, 8],
                    backgroundColor: [
                        '#4361ee',
                        '#3f37c9',
                        '#4895ef',
                        '#4cc9f0',
                        '#560bad',
                        '#7209b7'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endsection