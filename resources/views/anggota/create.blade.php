@extends('layouts.app')

@section('content')
    <h3>Tambah Anggota Keluarga</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anggota.store', $keluarga->id) }}" method="POST">
        @csrf

        <input type="hidden" name="keluarga_id" value="{{ $keluarga->id }}">

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik') }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" value="{{ old('usia') }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Hubungan dengan Kepala Keluarga</label>
            <input type="text" name="hubungan_dengan_kepala" class="form-control" value="{{ old('hubungan_dengan_kepala') }}">
        </div>

        <div class="mb-3">
            <label>Pekerjaan (Opsional)</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan') }}">
        </div>

        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
        </div>

        <div class="mb-3">
            <label>Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Tidak Sekolah" {{ old('pendidikan_terakhir') == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                <option value="SD" {{ old('pendidikan_terakhir') == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pendidikan_terakhir') == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ old('pendidikan_terakhir') == 'SMA' ? 'selected' : '' }}>SMA</option>
                <option value="Diploma" {{ old('pendidikan_terakhir') == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                <option value="S1" {{ old('pendidikan_terakhir') == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ old('pendidikan_terakhir') == 'S2' ? 'selected' : '' }}>S2</option>
                <option value="S3" {{ old('pendidikan_terakhir') == 'S3' ? 'selected' : '' }}>S3</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Belum Kawin" {{ old('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <select name="agama" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                <option value="Lainnya" {{ old('agama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kewarganegaraan</label>
            <select name="kewarganegaraan" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Indonesia" {{ old('kewarganegaraan') == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                <option value="Asing" {{ old('kewarganegaraan') == 'Asing' ? 'selected' : '' }}>Asing</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Penghasilan (Rp)</label>
            <input type="number" name="penghasilan" class="form-control" value="{{ old('penghasilan') }}" step="0.01">
        </div>

        <div class="mb-3 form-check">
        <input type="hidden" name="bpjs" value="0">
        <input type="checkbox" name="bpjs" class="form-check-input" id="bpjsCheck" value="1" {{ old('bpjs') ? 'checked' : '' }}>
        <label class="form-check-label" for="bpjsCheck">Memiliki BPJS</label>
    </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection