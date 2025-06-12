@extends('layouts.app')

@section('content')
    <h3>Tambah Data Keluarga</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('keluarga.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" class="form-control" value="{{ old('nama_kepala_keluarga') }}">
        </div>

        <div class="mb-3">
            <label>Nomor KK</label>
            <input type="text" name="nomor_kk" class="form-control" value="{{ old('nomor_kk') }}" required>
        </div>

        <div class="mb-3">
            <label>NIK Kepala Keluarga</label>
            <input type="text" name="nik_kepala_keluarga" class="form-control" value="{{ old('nik_kepala_keluarga') }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat') }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>RT</label>
                <input type="text" name="rt" class="form-control" value="{{ old('rt') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>RW</label>
                <input type="text" name="rw" class="form-control" value="{{ old('rw') }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Desa / Kelurahan</label>
            <input type="text" name="desa" class="form-control" value="{{ old('desa') }}">
        </div>

        <div class="mb-3">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}">
        </div>

        <div class="mb-3">
            <label>Kategori Kemiskinan</label>
            <select name="kategori_kemiskinan" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach(['rentan miskin', 'miskin', 'menuju kelas menengah', 'kelas menengah', 'kelas atas'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori_kemiskinan') == $kategori ? 'selected' : '' }}>
                        {{ ucfirst($kategori) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Bagian bantuan dihapus -->

        <div class="mb-3">
            <label>Lokasi (klik pada peta)</label>
            <div id="map" style="height: 300px;"></div>
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        var map = L.map('map').setView([-0.0263, 109.3432], 13); // Kota Pontianak
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        let marker;
        const latInput = document.getElementById('latitude');
        const lngInput = document.getElementById('longitude');

        function setMarker(lat, lng) {
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
            latInput.value = lat;
            lngInput.value = lng;
        }

        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });

        // Set marker jika sudah ada nilai lama
        @if(old('latitude') && old('longitude'))
            setMarker({{ old('latitude') }}, {{ old('longitude') }});
        @endif
    </script>
@endsection
