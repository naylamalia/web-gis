<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pendataan Keluarga Kurang Mampu</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    @stack('styles')
    <style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f8f9fa;
        overflow-x: hidden;
    }

    .sidebar {
        height: 100vh;
        background: linear-gradient(180deg, #1e3c72, #2a5298, #2c3e50);
        color: #fff;
        padding-top: 1.5rem;
        box-shadow: 2px 0 10px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        position: fixed;
        width: 250px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
    }

    /* Sidebar mini mode */
    .sidebar.mini {
        width: 70px;
    }

    .sidebar.mini .brand span {
        display: none;
    }
    
    .sidebar.mini .brand .home-icon {
        display: none;
    }
    
    .sidebar.mini .brand .collapse-btn {
        display: none;
    }
    
    .sidebar.mini .brand .expand-icon {
        display: block;
        margin: 0 auto;
        cursor: pointer;
        padding: 5px;
        border-radius: 50%;
        transition: all 0.3s;
    }
    
    .sidebar.mini .brand .expand-icon:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .sidebar.mini .nav-link span {
        display: none;
    }

    .sidebar.mini .nav-link {
        justify-content: center;
        padding: 12px;
    }

    .sidebar.mini .nav-link i {
        margin-right: 0;
        font-size: 1.3rem;
    }

    .sidebar.mini .back-btn span {
        display: none;
    }

    .sidebar.mini .back-btn {
        justify-content: center;
    }

    .sidebar.mini .back-btn i {
        margin-right: 0;
    }

    .sidebar .brand {
        font-size: 1.4rem;
        font-weight: bold;
        padding: 0 1.5rem 1rem;
        color: #f1f1f1;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .sidebar .brand .expand-icon {
        display: none;
        font-size: 1.5rem;
    }

    .sidebar .brand-text {
        display: flex;
        align-items: center;
    }

    .sidebar .nav-link {
        color: #cfd8dc;
        padding: 12px 20px;
        border-radius: 10px;
        transition: 0.3s;
        display: flex;
        align-items: center;
        font-weight: 500;
        margin: 5px 10px;
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
        transition: all 0.3s ease;
    }
    
    /* Tombol kembali di bagian bawah */
    .back-btn {
        margin-top: auto;
        background-color: rgba(255, 255, 255, 0.1);
        border-radius: 8px;
        margin: 20px 10px;
        padding: 12px 20px;
        color: #fff;
        text-align: center;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .back-btn:hover {
        background-color: rgba(255, 70, 70, 0.2);
        color: #fff;
        transform: translateX(3px);
    }
    
    .back-btn i {
        margin-right: 10px;
    }
    
    /* Toggle button untuk responsif */
    .toggle-btn {
        position: fixed;
        left: 10px;
        top: 10px;
        background-color: #1e3c72;
        color: white;
        border: none;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        z-index: 1001;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    }
    
    /* Tombol untuk mengecilkan sidebar */
    .collapse-btn {
        background: none;
        color: white;
        border: none;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        padding: 0;
    }

    .collapse-btn:hover {
        color: #90caf9;
    }
    
    /* Responsif untuk layar kecil */
    @media (max-width: 768px) {
        .sidebar {
            left: -250px;
        }
        
        .sidebar.active {
            left: 0;
        }
        
        .toggle-btn {
            display: flex;
        }
        
        main.col-md-9 {
            margin-left: 0;
            width: 100%;
            max-width: 100%;
            flex: 0 0 100%;
        }
        
        main.sidebar-active {
            margin-left: 250px;
        }

        .collapse-btn {
            display: none;
        }
        
        .sidebar.mini .brand .expand-icon {
            display: none;
        }
    }
    
    /* Spacer untuk mendorong tombol kembali ke bawah */
    .spacer {
        flex-grow: 1;
    }

    /* Transisi untuk main content saat sidebar mengecil */
    #main-content {
        transition: margin-left 0.3s ease;
    }

    #main-content.mini-margin {
        margin-left: 70px;
    }
    </style>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @if (! View::hasSection('sidebar'))
            {{-- Toggle Button --}}
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="bi bi-list"></i>
            </button>
            
            {{-- Sidebar default --}}
            <nav id="sidebar" class="col-md-2 d-md-block sidebar">
                <div class="brand px-3 mb-3">
                    <div class="brand-text">
                        <i class="bi bi-house-door-fill me-2 home-icon"></i> 
                        <span>Web-Gis</span>
                        <i class="bi bi-arrow-right-circle-fill expand-icon" onclick="collapseSidebar()"></i>
                    </div>
                    <button class="collapse-btn" onclick="collapseSidebar()" id="collapseBtn">
                        <i class="bi bi-arrow-left-circle-fill" id="collapseIcon"></i>
                    </button>
                </div>
                <div class="sidebar-heading"></div>
                <ul class="nav flex-column px-2">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('keluarga.index') ? 'active' : '' }}" href="{{ route('keluarga.index') }}">
                            <i class="bi bi-people-fill"></i> <span>Daftar Keluarga</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('webgis') ? 'active' : '' }}" href="{{ route('webgis') }}">
                            <i class="bi bi-geo-alt-fill"></i> <span>Peta Keluarga Kurang Mampu</span>
                        </a>
                    </li>
                </ul>
                
                <!-- Spacer untuk mendorong tombol kembali ke bawah -->
                <div class="spacer"></div>
                
                <!-- Tombol Kembali -->
                <a href="http://127.0.0.1:8000/" class="back-btn">
                    <i class="bi bi-box-arrow-left"></i> <span>Kembali</span>
                </a>
            </nav>
            <main id="main-content" class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
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

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        sidebar.classList.toggle('active');
        
        // Hanya tambahkan class pada layar kecil
        if (window.innerWidth <= 768) {
            mainContent.classList.toggle('sidebar-active');
        }
    }
    
    function collapseSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        sidebar.classList.toggle('mini');
        mainContent.classList.toggle('mini-margin');
        
        // Simpan status sidebar ke localStorage
        if (sidebar.classList.contains('mini')) {
            localStorage.setItem('sidebarState', 'mini');
        } else {
            localStorage.setItem('sidebarState', 'full');
        }
    }
    
    // Tambahkan event listener untuk menyesuaikan tampilan saat ukuran layar berubah
    window.addEventListener('resize', function() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            mainContent.classList.remove('sidebar-active');
        }
    });
    
    // Periksa status sidebar dari localStorage saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const sidebarState = localStorage.getItem('sidebarState');
        if (sidebarState === 'mini') {
            collapseSidebar();
        }
    });
</script>
</body>
</html>