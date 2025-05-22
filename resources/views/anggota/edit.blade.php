@extends('layouts.app')

@section('content')
    <h3>Edit Anggota Keluarga</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="keluarga_id" value="{{ $anggota->keluarga_id }}">

        <div class="mb-3">
            <label>NIK</label>
            <input type="text" name="nik" class="form-control" value="{{ old('nik', $anggota->nik) }}">
        </div>

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $anggota->nama) }}">
        </div>

        <div class="mb-3">
            <label>Usia</label>
            <input type="number" name="usia" class="form-control" value="{{ old('usia', $anggota->usia) }}">
        </div>

        <div class="mb-3">
            <label>Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control">
                <option value="Laki-laki" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ old('jenis_kelamin', $anggota->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Hubungan dengan Kepala Keluarga</label>
            <input type="text" name="hubungan_dengan_kepala" class="form-control" value="{{ old('hubungan_dengan_kepala', $anggota->hubungan_dengan_kepala) }}">
        </div>

        <div class="mb-3">
            <label>Pekerjaan (Opsional)</label>
            <input type="text" name="pekerjaan" class="form-control" value="{{ old('pekerjaan', $anggota->pekerjaan) }}">
        </div>

        <div class="mb-3">
            <label>Tempat Lahir</label>
            <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir', $anggota->tempat_lahir) }}">
        </div>

        <div class="mb-3">
            <label>Tanggal Lahir</label>
            <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir', $anggota->tanggal_lahir) }}">
        </div>

        <div class="mb-3">
            <label>Pendidikan Terakhir</label>
            <select name="pendidikan_terakhir" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Tidak Sekolah" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'Tidak Sekolah' ? 'selected' : '' }}>Tidak Sekolah</option>
                <option value="SD" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SD' ? 'selected' : '' }}>SD</option>
                <option value="SMP" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMP' ? 'selected' : '' }}>SMP</option>
                <option value="SMA" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'SMA' ? 'selected' : '' }}>SMA</option>
                <option value="Diploma" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'Diploma' ? 'selected' : '' }}>Diploma</option>
                <option value="S1" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S1' ? 'selected' : '' }}>S1</option>
                <option value="S2" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S2' ? 'selected' : '' }}>S2</option>
                <option value="S3" {{ old('pendidikan_terakhir', $anggota->pendidikan_terakhir) == 'S3' ? 'selected' : '' }}>S3</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Status Perkawinan</label>
            <select name="status_perkawinan" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Belum Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                <option value="Kawin" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                <option value="Cerai Hidup" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                <option value="Cerai Mati" {{ old('status_perkawinan', $anggota->status_perkawinan) == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Agama</label>
            <select name="agama" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Islam" {{ old('agama', $anggota->agama) == 'Islam' ? 'selected' : '' }}>Islam</option>
                <option value="Kristen" {{ old('agama', $anggota->agama) == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                <option value="Katolik" {{ old('agama', $anggota->agama) == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                <option value="Hindu" {{ old('agama', $anggota->agama) == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                <option value="Buddha" {{ old('agama', $anggota->agama) == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                <option value="Konghucu" {{ old('agama', $anggota->agama) == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                <option value="Lainnya" {{ old('agama', $anggota->agama) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Kewarganegaraan</label>
            <select name="kewarganegaraan" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Indonesia" {{ old('kewarganegaraan', $anggota->kewarganegaraan) == 'Indonesia' ? 'selected' : '' }}>Indonesia</option>
                <option value="Asing" {{ old('kewarganegaraan', $anggota->kewarganegaraan) == 'Asing' ? 'selected' : '' }}>Asing</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Penghasilan (Rp)</label>
            <input type="number" name="penghasilan" class="form-control" value="{{ old('penghasilan', $anggota->penghasilan) }}" step="0.01">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" name="bpjs" class="form-check-input" id="bpjsCheck" {{ old('bpjs', $anggota->bpjs) ? 'checked' : '' }}>
            <label class="form-check-label" for="bpjsCheck">Memiliki BPJS</label>
        </div>

        <button class="btn btn-primary">Perbarui</button>
        <a href="{{ route('keluarga.show', $anggota->keluarga_id) }}" class="btn btn-secondary">Kembali</a>
    </form>
@endsection