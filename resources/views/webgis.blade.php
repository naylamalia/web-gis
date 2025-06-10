@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Peta Sebaran Keluarga Kurang Mampu</h2>
        <p class="text-muted">Menampilkan seluruh data keluarga kurang mampu di Kota Pontianak secara geospasial</p>
    </div>

    {{-- Fitur Cari --}}
    <div class="row mb-3">
        <div class="col-md-6 mx-auto">
            <input type="text" id="searchInput" class="form-control" placeholder="Cari nama kepala keluarga atau alamat...">
            <div id="searchResults" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div id="map" style="height: 600px; width: 100%; border-radius: .5rem;"></div>
        </div>
    </div>
</div>

<script>
    var map = L.map('map').setView([-0.02633, 109.3425], 13);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // Data marker untuk pencarian
    var keluargaMarkers = [
        @foreach($keluargas as $keluarga)
            @if($keluarga->latitude && $keluarga->longitude)
            {
                id: {{ $keluarga->id }},
                nama: "{{ addslashes($keluarga->nama_kepala_keluarga) }}",
                alamat: "{{ addslashes($keluarga->alamat) }}",
                lat: {{ $keluarga->latitude }},
                lng: {{ $keluarga->longitude }},
                popup: `
                    <div style="max-width: 250px;">
                        <h5 class="mb-1">{{ $keluarga->nama_kepala_keluarga }}</h5>
                        <p class="mb-1 text-muted small">{{ $keluarga->alamat }}<br>
                        RT/RW: {{ $keluarga->rt }}/{{ $keluarga->rw }}<br>
                        Kategori: <span class="badge bg-secondary">{{ $keluarga->kategori_kemiskinan }}</span></p>
                        <div class="d-grid gap-2">
                            <a href='{{ route('keluarga.show', $keluarga->id) }}' class='btn btn-sm btn-outline-info'>Detail</a>
                            <a href='{{ route('keluarga.edit', $keluarga->id) }}' class='btn btn-sm btn-outline-warning'>Edit</a>
                            <form action='{{ route('keluarga.destroy', $keluarga->id) }}' method='POST' onsubmit="return confirm('Anda yakin ingin menghapus data ini??')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type='submit' class='btn btn-sm btn-outline-danger w-100'>Hapus</button>
                            </form>
                        </div>
                    </div>
                `
            },
            @endif
        @endforeach
    ];

    // Buat marker dan simpan referensinya
    var markerRefs = {};
    keluargaMarkers.forEach(function(item) {
        var marker = L.marker([item.lat, item.lng])
            .addTo(map)
            .bindPopup(item.popup);
        markerRefs[item.id] = marker;
    });

    // Fitur pencarian
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');

    searchInput.addEventListener('input', function() {
        const query = this.value.toLowerCase();
        searchResults.innerHTML = '';
        if (query.length < 2) return;

        const filtered = keluargaMarkers.filter(item =>
            item.nama.toLowerCase().includes(query) ||
            item.alamat.toLowerCase().includes(query)
        );

        filtered.forEach(item => {
            const el = document.createElement('a');
            el.className = 'list-group-item list-group-item-action';
            el.textContent = item.nama + ' - ' + item.alamat;
            el.href = '#';
            el.onclick = function(e) {
                e.preventDefault();
                map.setView([item.lat, item.lng], 16);
                markerRefs[item.id].openPopup();
                searchResults.innerHTML = '';
                searchInput.value = item.nama;
            };
            searchResults.appendChild(el);
        });
    });

    // Tutup hasil pencarian jika klik di luar
    document.addEventListener('click', function(e) {
        if (!searchResults.contains(e.target) && e.target !== searchInput) {
            searchResults.innerHTML = '';
        }
    });
</script>
@endsection