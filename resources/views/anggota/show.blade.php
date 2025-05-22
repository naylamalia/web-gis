{{-- filepath: resources/views/anggota/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h3>Detail Anggota Keluarga</h3>
    <div class="card mb-3">
        <div class="card-body">
            <table class="table table-borderless">
                <tr>
                    <th width="200">NIK</th>
                    <td>{{ $anggota->nik }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $anggota->nama }}</td>
                </tr>
                <tr>
                    <th>Usia</th>
                    <td>{{ $anggota->usia }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $anggota->jenis_kelamin }}</td>
                </tr>
                <tr>
                    <th>Hubungan dengan Kepala</th>
                    <td>{{ $anggota->hubungan_dengan_kepala }}</td>
                </tr>
                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $anggota->pekerjaan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>
                        {{ $anggota->tempat_lahir ?? '-' }},
                        {{ $anggota->tanggal_lahir ? \Carbon\Carbon::parse($anggota->tanggal_lahir)->format('d-m-Y') : '-' }}
                    </td>
                </tr>
                <tr>
                    <th>Pendidikan Terakhir</th>
                    <td>{{ $anggota->pendidikan_terakhir ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status Perkawinan</th>
                    <td>{{ $anggota->status_perkawinan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Agama</th>
                    <td>{{ $anggota->agama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Kewarganegaraan</th>
                    <td>{{ $anggota->kewarganegaraan ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Penghasilan</th>
                    <td>
                        @if($anggota->penghasilan)
                            Rp{{ number_format($anggota->penghasilan, 0, ',', '.') }}
                        @else
                            -
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>BPJS</th>
                    <td>
                        @if($anggota->bpjs)
                            <span class="badge bg-success">Ya</span>
                        @else
                            <span class="badge bg-secondary">Tidak</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th>Keluarga</th>
                    <td>
                        <a href="{{ route('keluarga.show', $keluarga->id) }}">
                            {{ $keluarga->nama_kepala_keluarga }}
                        </a>
                    </td>
                </tr>
            </table>
            <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn btn-secondary mt-3">Kembali ke Detail Keluarga</a>
            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-primary mt-3">Edit Anggota</a>
        </div>
    </div>
@endsection