@extends('layouts.app')

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 80px 0;
        margin-bottom: 50px;
    }

    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    }

    .about-hero .subtitle {
        font-size: 1.3rem;
        opacity: 0.9;
        margin-bottom: 30px;
    }

    .feature-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
    }

    .team-card {
        background: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
        margin-bottom: 30px;
    }

    .team-card:hover {
        transform: translateY(-5px);
    }

    .team-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2.5rem;
        font-weight: bold;
    }

    .team-name {
        font-size: 1.4rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 5px;
    }

    .team-nim {
        color: #7f8c8d;
        font-weight: 500;
        margin-bottom: 10px;
    }

    .team-role {
        color: #667eea;
        font-style: italic;
        font-size: 0.9rem;
    }

    .stats-card {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        margin-bottom: 20px;
    }

    .stats-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .section-title {
        font-size: 2.5rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 50px;
        color: #2c3e50;
        position: relative;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 2px;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<div class="about-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1>{{ $sistemInfo['nama'] }}</h1>
                <p class="subtitle">{{ $sistemInfo['nama_lengkap'] }}</p>
                <p class="lead">{{ $sistemInfo['deskripsi'] }}</p>
                <div class="d-flex align-items-center">
                    <span class="badge bg-light text-dark me-3 px-3 py-2">
                        <i class="bi bi-code-square me-2"></i>Versi {{ $sistemInfo['versi'] }}
                    </span>
                    <span class="badge bg-light text-dark px-3 py-2">
                        <i class="bi bi-calendar me-2"></i>{{ $sistemInfo['tahun'] }}
                    </span>
                </div>
            </div>
            <div class="col-lg-4 text-center">
                <div class="feature-icon" style="width: 150px; height: 150px; font-size: 4rem;">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-5">
    <!-- Fitur Utama -->
    <h2 class="section-title">Fitur Utama Sistem</h2>
    <div class="row mb-5">
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h4 class="text-center mb-3">Manajemen Data Keluarga</h4>
                <p class="text-center text-muted">Pengelolaan data keluarga penerima bantuan sosial dengan sistem yang terintegrasi dan mudah digunakan.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
                <h4 class="text-center mb-3">Pemetaan Spasial</h4>
                <p class="text-center text-muted">Visualisasi sebaran keluarga penerima bantuan dalam bentuk peta interaktif dengan filter tahun.</p>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="feature-card">
                <div class="feature-icon">
                    <i class="bi bi-graph-up"></i>
                </div>
                <h4 class="text-center mb-3">Analisis & Laporan</h4>
                <p class="text-center text-muted">Sistem pelaporan dan analisis data bantuan sosial untuk mendukung pengambilan keputusan.</p>
            </div>
        </div>
    </div>

    <!-- Statistik -->
    <div class="row mb-5">
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">5</div>
                <div>Developer</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">3</div>
                <div>Modul Utama</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">10+</div>
                <div>Fitur</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stats-card">
                <div class="stats-number">100%</div>
                <div>Responsive</div>
            </div>
        </div>
    </div>

    <!-- Tim Pengembang -->
    <h2 class="section-title">Tim Pengembang</h2>
    <div class="row">
        @foreach($anggotaTim as $anggota)
        <div class="col-lg-4 col-md-6">
            <div class="team-card">
                <div class="team-avatar">
                    {{ strtoupper(substr($anggota['nama'], 0, 2)) }}
                </div>
                <div class="team-name">{{ $anggota['nama'] }}</div>
                <div class="team-nim">{{ $anggota['nim'] }}</div>
                <div class="team-role">{{ $anggota['role'] }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Teknologi yang Digunakan -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="feature-card">
                <h3 class="text-center mb-4">Teknologi yang Digunakan</h3>
                <div class="row text-center">
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-code-slash fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>Laravel</strong></p>
                        <small class="text-muted">Framework PHP</small>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-bootstrap fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>Bootstrap</strong></p>
                        <small class="text-muted">CSS Framework</small>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-database fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>MySQL</strong></p>
                        <small class="text-muted">Database</small>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-map fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>Leaflet</strong></p>
                        <small class="text-muted">Mapping Library</small>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-git fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>Git</strong></p>
                        <small class="text-muted">Version Control</small>
                    </div>
                    <div class="col-md-2 col-4 mb-3">
                        <i class="bi bi-github fs-1 text-primary"></i>
                        <p class="mt-2 mb-0"><strong>GitHub</strong></p>
                        <small class="text-muted">Repository</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
