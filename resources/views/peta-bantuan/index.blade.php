@extends('layouts.app')

@section('title', 'Peta Bantuan - Sebaran Keluarga Penerima Bantuan')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <h2><i class="bi bi-geo-alt-fill text-primary"></i> Status Bantuan</h2>
                <div class="d-flex align-items-center">
                    <span class="me-2">Filter Tahun:</span>
                    <form method="GET" class="d-inline">
                        <select name="tahun" class="form-select" onchange="this.form.submit()">
                            <option value="">Semua Tahun</option>
                            @foreach($tahun_tersedia as $tahun)
                                <option value="{{ $tahun }}" {{ $tahun_filter == $tahun ? 'selected' : '' }}>
                                    {{ $tahun }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body text-center">
                    <i class="bi bi-people-fill fs-1"></i>
                    <h3 class="mt-2">{{ $total_keluarga }}</h3>
                    <p class="mb-0">Total Keluarga</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="bi bi-check-circle-fill fs-1"></i>
                    <h3 class="mt-2">{{ $penerima_bantuan }}</h3>
                    <p class="mb-0">Penerima Bantuan {{ $tahun_filter }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <i class="bi bi-x-circle-fill fs-1"></i>
                    <h3 class="mt-2">{{ $belum_menerima }}</h3>
                    <p class="mb-0">Belum Menerima {{ $tahun_filter }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Peta -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-map"></i> Sebaran Spasial Keluarga Penerima Bantuan Tahun {{ $tahun_filter }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <!-- Legenda -->
                <div class="p-3 bg-light border-bottom">
                    <strong>Legenda:</strong>
                    <span class="me-3">
                        <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png" 
                            width="15" height="24" class="me-1">
                        Penerima Bantuan Aktif
                    </span>
                    <span class="me-3">
                        <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png" 
                            width="15" height="24" class="me-1">
                        Bantuan Non-Aktif
                    </span>
                    <span class="me-3">
                        <img src="https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png" 
                            width="15" height="24" class="me-1">
                        Belum Menerima Bantuan
                    </span>
                </div>

                    
                    <!-- Map Container -->
                    <div id="petaBantuan" style="height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk Peta -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi peta
        var map = L.map('petaBantuan').setView([-0.0263, 109.3432], 12);
        
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Data keluarga dari controller
        var keluargaData = @json($keluargas);
        var tahunFilter = '{{ $tahun_filter }}';

        // Fungsi untuk membuat icon marker berdasarkan status
        function createMarkerIcon(status) {
            let iconUrl;
            
            if (status === 'penerima_aktif') {
                // Marker hijau untuk penerima bantuan aktif
                iconUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png';
            } else if (status === 'bantuan_non_aktif') {
                // Marker kuning untuk bantuan non-aktif
                iconUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-yellow.png';
            } else {
                // Marker merah untuk belum menerima bantuan
                iconUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png';
            }

            return new L.Icon({
                iconUrl: iconUrl,
                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
        }

        // Fungsi untuk menentukan status bantuan
        function getBantuanStatus(keluarga) {
            if (keluarga.bantuan_kk && keluarga.bantuan_kk.length > 0) {
                var bantuan = keluarga.bantuan_kk[0];
                return bantuan.status === 'aktif' ? 'penerima_aktif' : 'bantuan_non_aktif';
            }
            return 'belum_menerima';
        }

        // Tambahkan marker untuk setiap keluarga
        keluargaData.forEach(function(keluarga) {
            if (keluarga.latitude && keluarga.longitude) {
                var status = getBantuanStatus(keluarga);
                var icon = createMarkerIcon(status);
                
                // Tentukan status bantuan untuk popup
                var statusBantuan = 'Belum menerima bantuan';
                var nominalBantuan = '-';
                var tanggalCair = '-';
                var badgeClass = 'bg-danger';
                
                if (keluarga.bantuan_kk && keluarga.bantuan_kk.length > 0) {
                    var bantuan = keluarga.bantuan_kk[0];
                    statusBantuan = bantuan.status === 'aktif' ? 'Penerima Aktif' : 'Non-Aktif';
                    nominalBantuan = 'Rp ' + new Intl.NumberFormat('id-ID').format(bantuan.nominal);
                    tanggalCair = bantuan.tanggal_cair || '-';
                    badgeClass = bantuan.status === 'aktif' ? 'bg-success' : 'bg-warning';
                }

                var marker = L.marker([keluarga.latitude, keluarga.longitude], {icon: icon}).addTo(map);
                
                // Popup content
                var popupContent = `
                    <div style="min-width: 280px;">
                        <div class="text-center mb-2">
                            <h6 class="fw-bold text-primary">${keluarga.nama_kepala_keluarga}</h6>
                        </div>
                        
                        <table class="table table-sm table-borderless">
                            <tr><td><strong>No KK:</strong></td><td>${keluarga.nomor_kk}</td></tr>
                            <tr><td><strong>Alamat:</strong></td><td>${keluarga.alamat}</td></tr>
                            <tr><td><strong>RT/RW:</strong></td><td>${keluarga.rt}/${keluarga.rw}</td></tr>
                            <tr><td><strong>Kategori:</strong></td><td>${keluarga.kategori_kemiskinan}</td></tr>
                        </table>
                        
                        <hr class="my-2">
                        
                        <div class="text-center mb-2">
                            <span class="badge ${badgeClass}">${statusBantuan} ${tahunFilter}</span>
                        </div>
                        
                        <table class="table table-sm table-borderless">
                            <tr><td><strong>Nominal:</strong></td><td>${nominalBantuan}</td></tr>
                            <tr><td><strong>Tanggal Cair:</strong></td><td>${tanggalCair}</td></tr>
                        </table>
                        
                        <div class="text-center mt-3">
                            <a href="/keluarga/${keluarga.id}" class="btn btn-primary btn-sm">
                                <i class="bi bi-eye"></i> Detail Keluarga
                            </a>
                        </div>
                    </div>
                `;
                
                marker.bindPopup(popupContent, {
                    maxWidth: 300,
                    className: 'custom-popup'
                });
            }
        });

        // Auto fit bounds jika ada data
        if (keluargaData.length > 0) {
            var group = new L.featureGroup();
            keluargaData.forEach(function(keluarga) {
                if (keluarga.latitude && keluarga.longitude) {
                    group.addLayer(L.marker([keluarga.latitude, keluarga.longitude]));
                }
            });
            map.fitBounds(group.getBounds().pad(0.1));
        }
    });
</script>

<style>
.custom-marker {
    background: transparent;
    border: none;
}

.custom-popup .leaflet-popup-content-wrapper {
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.custom-popup .leaflet-popup-content {
    margin: 12px;
}
</style>
@endsection
