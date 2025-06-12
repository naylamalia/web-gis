@extends('layouts.app')

@section('content')
    <h3>Detail Data Keluarga</h3>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>Nomor KK:</strong> {{ $keluarga->nomor_kk }}</p>
            <p><strong>NIK Kepala Keluarga:</strong> {{ $keluarga->nik_kepala_keluarga }}</p>
            <p><strong>Nama Kepala Keluarga:</strong> {{ $keluarga->nama_kepala_keluarga }}</p>
            <p><strong>Alamat:</strong> {{ $keluarga->alamat }}</p>
            <p><strong>RT / RW:</strong> {{ $keluarga->rt }} / {{ $keluarga->rw }}</p>
            <p><strong>Desa / Kelurahan:</strong> {{ $keluarga->desa }}</p>
            <p><strong>Kecamatan:</strong> {{ $keluarga->kecamatan }}</p>
            <p><strong>Kategori Kemiskinan:</strong> {{ ucfirst($keluarga->kategori_kemiskinan) }}</p>
        </div>
    </div>

    {{-- Tampilkan daftar anggota keluarga --}}
    <div class="card mb-3">
        <div class="card-header">
            <strong>Anggota Keluarga</strong>
            <a href="{{ route('anggota.create', $keluarga->id) }}" class="btn btn-success btn-sm float-end">Tambah Anggota</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Usia</th>
                        <th>Jenis Kelamin</th>
                        <th>Hubungan</th>
                        <th>Pekerjaan</th>
                        <th>Pendidikan</th>
                        <th>Status Kawin</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($keluarga->anggotaKeluarga ?? [] as $anggota)
                    <tr>
                        <td>{{ $anggota->nik }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->usia }}</td>
                        <td>{{ $anggota->jenis_kelamin }}</td>
                        <td>{{ $anggota->hubungan_dengan_kepala }}</td>
                        <td>{{ $anggota->pekerjaan ?? '-' }}</td>
                        <td>{{ $anggota->pendidikan_terakhir ?? '-' }}</td>
                        <td>{{ $anggota->status_perkawinan ?? '-' }}</td>
                        <td>
                            <a href="{{ route('anggota.show', $anggota->id) }}" class="btn btn-info btn-sm me-1">
                                <i class="bi bi-eye"></i> 
                            </a>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> 
                            </a>
                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini??')">
                                    <i class="bi bi-trash3"></i> 
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">Belum ada anggota keluarga.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Tampilkan daftar riwayat bantuan per tahun --}}
    <div class="card mb-3">
        <div class="card-header">
            <strong>Riwayat Bantuan</strong>
            <a href="{{ route('bantuan.create', $keluarga->id) }}" class="btn btn-success btn-sm float-end">Tambah Bantuan</a>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead>
                    <tr>
                        <th>Tahun Anggaran</th>
                        <th>Status</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($keluarga->bantuanKk ?? [] as $bantuan)
                    <tr>
                        <td>{{ $bantuan->tahun_anggaran }}</td>
                        <td>
                            <span class="badge {{ $bantuan->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($bantuan->status) }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($bantuan->nominal, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('bantuan.edit', $bantuan->id) }}" class="btn btn-warning btn-sm me-1">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('bantuan.destroy', $bantuan->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini??')">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Belum ada riwayat bantuan.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div id="map" style="height: 400px;"></div>

    <a href="{{ route('keluarga.index') }}" class="btn btn-secondary mt-3">Kembali</a>

    <script>
        var map = L.map('map').setView([{{ $keluarga->latitude }}, {{ $keluarga->longitude }}], 15);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

        var marker = L.marker([{{ $keluarga->latitude }}, {{ $keluarga->longitude }}]).addTo(map);
        marker.bindPopup("<b>{{ $keluarga->nama_kepala_keluarga }}</b><br>{{ $keluarga->alamat }}").openPopup();
    </script>
@endsection
