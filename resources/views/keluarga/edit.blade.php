@extends('layouts.app')

@section('content')
    <h3>Edit Data Keluarga</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('keluarga.update', $keluarga->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kepala Keluarga</label>
            <input type="text" name="nama_kepala_keluarga" class="form-control" value="{{ old('nama_kepala_keluarga', $keluarga->nama_kepala_keluarga) }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="form-control">{{ old('alamat', $keluarga->alamat) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>RT</label>
                <input type="text" name="rt" class="form-control" value="{{ old('rt', $keluarga->rt) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label>RW</label>
                <input type="text" name="rw" class="form-control" value="{{ old('rw', $keluarga->rw) }}">
            </div>
        </div>

        <div class="mb-3">
            <label>Desa</label>
            <input type="text" name="desa" class="form-control" value="{{ old('desa', $keluarga->desa) }}">
        </div>

        <div class="mb-3">
            <label>Kecamatan</label>
            <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan', $keluarga->kecamatan) }}">
        </div>

        <div class="mb-3">
            <label>Kategori Kemiskinan</label>
            <select name="kategori_kemiskinan" class="form-control">
                <option value="">-- Pilih --</option>
                @foreach(['sangat miskin', 'miskin', 'sedang miskin'] as $kategori)
                    <option value="{{ $kategori }}" {{ old('kategori_kemiskinan', $keluarga->kategori_kemiskinan) == $kategori ? 'selected' : '' }}>
                        {{ ucfirst($kategori) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bantuan</label>
            <input type="text" name="bantuan" class="form-control" value="{{ old('bantuan', $keluarga->bantuan) }}">
        </div>

        <div class="mb-3">
            <label>Lokasi (klik pada peta)</label>
            <div id="map" style="height: 300px;"></div>
            <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $keluarga->latitude) }}">
            <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $keluarga->longitude) }}">
        </div>

        <button class="btn btn-success">Perbarui</button>
        <a href="{{ route('keluarga.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

    <script>
        var map = L.map('map').setView([{{ old('latitude', $keluarga->latitude) }}, {{ old('longitude', $keluarga->longitude) }}], 13);
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

        setMarker(latInput.value, lngInput.value);

        map.on('click', function(e) {
            setMarker(e.latlng.lat, e.latlng.lng);
        });
    </script>
@endsection
