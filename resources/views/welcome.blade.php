@extends('layouts.app')

@section('sidebar')
@endsection

@push('styles')
<style>
    body {
        background: linear-gradient(135deg, #0b0a0b, #05030d);
        min-height: 100vh;
        font-family: 'Poppins', sans-serif;
    }

    .dashboard-container {
        padding-top: 50px;
    }

    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border: none;
        border-radius: 1.5rem;
        box-shadow: 0 15px 30px rgba(12, 2, 2, 0.25);
        transition: 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    .card-header {
        background: linear-gradient(to right, #041a2f, #021021);
        color: white;
        border-top-left-radius: 1.5rem;
        border-top-right-radius: 1.5rem;
    }

    .btn-lg {
        font-size: 1.1rem;
        padding: 15px 20px;
        border-radius: 0.75rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .btn-lg i {
        font-size: 1.3rem;
        vertical-align: middle;
    }

    .stat-box {
        background: #f4f4f4;
        border-radius: 1rem;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.05);
    }

    .stat-box h4 {
        margin-bottom: 0;
        font-weight: 700;
        font-size: 1.5rem;
    }

    .quote-box {
        font-style: italic;
        font-size: 1rem;
        color: #555;
        margin-top: 30px;
    }
</style>
@endpush

@section('content')
<div class="container dashboard-container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card">
                <div class="card-header text-center">
                    <h2 class="mb-0">Web-Gis</h2>
                </div>
                <div class="card-body text-center">
                    <p class="lead mb-4">
                        Selamat datang di <strong>Sistem Pendataan Keluarga Kurang Sejahtera Kota Pontianak</strong>
                    </p>

                    {{-- Statistik Mini --}}
                    <div class="row mb-4">
        <div class="col-md-6">
            <div class="stat-box">
                <h4>{{ number_format($jumlahKeluarga) }}</h4>
                <p>Keluarga Terdaftar</p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-box">
                <h4>{{ $jumlahKecamatan }}</h4>
                <p>Kecamatan Tercover</p>
            </div>
        </div>
    </div>
                    {{-- Tombol Navigasi --}}
                    <div class="d-grid gap-3 col-md-8 mx-auto">
                        <a href="{{ route('keluarga.index') }}" class="btn btn-lg btn-success">
                            <i class="bi bi-people-fill me-2"></i> Daftar Keluarga
                        </a>
                        <a href="{{ route('webgis') }}" class="btn btn-lg btn-primary">
                            <i class="bi bi-geo-alt-fill me-2"></i> Peta Keluarga Kurang Sejahtera
                        </a>
                    </div>

                    {{-- Quote atau Motivasi --}}
                    <div class="quote-box">
                        <p>“Kelompok 10”</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
