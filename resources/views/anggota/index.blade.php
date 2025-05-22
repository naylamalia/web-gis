@extends('layouts.app')

@section('content')
    <h3>Daftar Anggota Keluarga</h3>

    <div class="mb-3">
        <a href="{{ route('anggota.create', $keluarga->id) }}" class="btn btn-success">Tambah Anggota</a>
        <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn btn-secondary">Kembali ke Detail Keluarga</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5><strong>Kepala Keluarga:</strong> {{ $keluarga->nama_kepala_keluarga }}</h5>
            <p><strong>Alamat:</strong> {{ $keluarga->alamat }}</p>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered mt-4">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Usia</th>
                    <th>Jenis Kelamin</th>
                    <th>Hubungan</th>
                    <th>Pekerjaan</th>
                    <th>Pendidikan</th>
                    <th>BPJS</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($anggotaList as $index => $anggota)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $anggota->nik }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->usia }}</td>
                        <td>{{ $anggota->jenis_kelamin }}</td>
                        <td>{{ $anggota->hubungan_dengan_kepala }}</td>
                        <td>{{ $anggota->pekerjaan ?? '-' }}</td>
                        <td>{{ $anggota->pendidikan_terakhir ?? '-' }}</td>
                        <td>
                            @if($anggota->bpjs)
                                <span class="badge bg-success">Ya</span>
                            @else
                                <span class="badge bg-secondary">Tidak</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('anggota.edit', $anggota->id) }}" class="btn btn-sm btn-primary">Edit</a>
                            <form action="{{ route('anggota.destroy', $anggota->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center">Belum ada anggota keluarga</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection