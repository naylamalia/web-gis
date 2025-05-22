@extends('layouts.app')

@section('sidebar')
@endsection

@push('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
        position: relative;
        overflow-x: hidden;
    }

    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.04)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
        z-index: 1;
    }

    .dashboard-container {
        padding-top: 60px;
        position: relative;
        z-index: 2;
    }

    .main-card {
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 2rem;
        box-shadow: 
            0 25px 50px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .main-card:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 
            0 35px 70px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.15) inset;
    }

    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 2rem 2rem 0 0;
        padding: 2rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }

    @keyframes shimmer {
        0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
        100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
    }

    .card-header h2 {
        font-weight: 700;
        font-size: 2.5rem;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        position: relative;
        z-index: 1;
    }

    .card-body {
        padding: 3rem;
    }

    .welcome-text {
        font-size: 1.2rem;
        color: #4a5568;
        margin-bottom: 2.5rem;
        line-height: 1.6;
    }

    .stats-container {
        margin-bottom: 3rem;
    }

    .stat-card {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 1.5rem;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 
            0 10px 25px rgba(0,0,0,0.08),
            0 0 0 1px rgba(255,255,255,0.5) inset;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #667eea, #764ba2);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 
            0 20px 40px rgba(0,0,0,0.12),
            0 0 0 1px rgba(255,255,255,0.7) inset;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #2d3748;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label {
        font-size: 1rem;
        color: #718096;
        font-weight: 500;
        margin: 0;
    }

    .navigation-buttons {
        margin-bottom: 2.5rem;
    }

    .nav-btn {
        font-size: 1.2rem;
        padding: 1.2rem 2rem;
        border-radius: 1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        border: none;
        position: relative;
        overflow: hidden;
        margin-bottom: 1rem;
        text-decoration: none;
        display: inline-block;
        width: 100%;
    }

    .nav-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .nav-btn:hover::before {
        left: 100%;
    }

    .btn-success-custom {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
        box-shadow: 0 10px 20px rgba(72, 187, 120, 0.3);
    }

    .btn-success-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(72, 187, 120, 0.4);
        color: white;
    }

    .btn-primary-custom {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        color: white;
        box-shadow: 0 10px 20px rgba(66, 153, 225, 0.3);
    }

    .btn-primary-custom:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(66, 153, 225, 0.4);
        color: white;
    }

    .nav-btn i {
        font-size: 1.4rem;
        margin-right: 0.8rem;
        vertical-align: middle;
    }

    .quote-section {
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 1.5rem;
        padding: 2rem;
        margin-top: 2rem;
        border-left: 5px solid #667eea;
        position: relative;
    }

    .quote-section::before {
        content: '"';
        position: absolute;
        top: -10px;
        left: 20px;
        font-size: 4rem;
        color: #667eea;
        opacity: 0.3;
        font-family: serif;
    }

    .quote-text {
        font-style: italic;
        font-size: 1.1rem;
        color: #4a5568;
        margin: 0;
        font-weight: 500;
        text-align: center;
    }

    /* Animasi masuk */
    .fade-in {
        animation: fadeInUp 0.8s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card-header h2 {
            font-size: 2rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
        
        .nav-btn {
            font-size: 1.1rem;
            padding: 1rem 1.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container dashboard-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="main-card fade-in">
                <div class="card-header">
                    <h2 class="mb-0">Web-Gis</h2>
                </div>
                <div class="card-body text-center">
                    <p class="welcome-text">
                        Selamat datang di <strong>Sistem Pendataan Keluarga Kurang Sejahtera Kota Pontianak</strong>
                    </p>

                    {{-- Statistik Mini --}}
                    <div class="stats-container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="stat-card">
                                    <div class="stat-number">{{ number_format($jumlahKeluarga) }}</div>
                                    <p class="stat-label">Keluarga Terdaftar</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="stat-card">
                                    <div class="stat-number">{{ $jumlahKecamatan }}</div>
                                    <p class="stat-label">Kecamatan Tercover</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Navigasi --}}
                    <div class="navigation-buttons">
                        <div class="d-grid gap-3 col-md-8 mx-auto">
                            <a href="{{ route('keluarga.index') }}" class="nav-btn btn-success-custom">
                                <i class="bi bi-people-fill"></i> Daftar Keluarga
                            </a>
                            <a href="{{ route('webgis') }}" class="nav-btn btn-primary-custom">
                                <i class="bi bi-geo-alt-fill"></i> Peta Keluarga Kurang Sejahtera
                            </a>
                        </div>
                    </div>

                    {{-- Quote atau Motivasi --}}
                    <div class="quote-section">
                        <p class="quote-text">Kelompok 10</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
