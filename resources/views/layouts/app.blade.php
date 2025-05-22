<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pendataan Keluarga Kurang Sejahtera</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    @stack('styles')
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
    }

    .sidebar {
        height: 100vh;
        background: linear-gradient(180deg, #0f2027, #06242f, #163768);
        color: #fff;
        padding-top: 1.5rem;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
    }

    .sidebar .brand {
        font-size: 1.4rem;
        font-weight: bold;
        padding: 0 1.5rem 1rem;
        color: #f1f1f1;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .sidebar .nav-link {
        color: #cfd8dc;
        padding: 12px 20px;
        border-radius: 10px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .sidebar .nav-link i {
        margin-right: 10px;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover,
    .sidebar .nav-link.active {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        transform: translateX(3px);
    }

    .sidebar-heading {
        text-transform: uppercase;
        font-size: 0.75rem;
        padding: 1rem 1.5rem 0.5rem;
        color: #90caf9;
        letter-spacing: 1px;
    }

    main {
        background: #ffffff;
        border-radius: 12px;
        padding: 2rem;
        margin-top: 1rem;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.05);
    }
</style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @if (! View::hasSection('sidebar'))
            {{-- Sidebar default --}}
        <nav class="col-md-2 d-none d-md-block sidebar">
            <div class="brand px-3 mb-3">
                <i class="bi bi-house-door-fill me-2"></i> Web-Gis
            <div class="sidebar-heading">    </div>
            <ul class="nav flex-column px-2">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('keluarga.index') ? 'active' : '' }}" href="{{ route('keluarga.index') }}">
                        <i class="bi bi-people-fill"></i> Daftar Keluarga
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('webgis') ? 'active' : '' }}" href="{{ route('webgis') }}">
                        <i class="bi bi-geo-alt-fill"></i> Peta Keluarga Kurang
                    </a>
                </li>
            </ul>
        </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                @yield('content')
            </main>
        @else
            {{-- Jika ada section sidebar, konten full width --}}
            <main class="col-12 px-md-4 py-4">
                @yield('content')
            </main>
        @endif
    </div>
</div>