@extends('layouts.app')

@push('styles')
<style>
    body {
        background: #090a0c;
        font-family: 'Poppins', sans-serif;
    }

    .table-container {
        background: white;
        padding: 30px;
        border-radius: 1rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    h3 {
        font-weight: 600;
        color: #2c3e50;
    }

    .btn-primary {
        background: #01010a;
        border: none;
        padding: 10px 20px;
        border-radius: 0.7rem;
        font-weight: 600;
    }

    .btn-primary:hover {
        background: #4ea8de;
    }

    .btn-sm {
        border-radius: 0.5rem;
        font-weight: 500;
    }

    .table thead {
        background: #5e60ce;
        color: white;
    }

    .table tbody tr:hover {
        background: #f3f3f3;
        transition: all 0.2s ease-in-out;
    }

    .table td, .table th {
        vertical-align: middle;
        text-align: center;
    }

    .btn-info {
        background: #48bfe3;
        border: none;
    }

    .btn-warning {
        background: #f9c74f;
        border: none;
        color: #2c3e50;
    }

    .btn-danger {
        background: #e63946;
        border: none;
    }

    /* Custom badge styles untuk status */
    .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container my-5">
    <div class="table-container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Data Keluarga</h3>
            <a href="{{ route('keluarga.create') }}" class="btn btn-primary shadow-sm">
                + Tambah Keluarga
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead>
                    <tr>
                        <th>Nama Kepala Keluarga</th>
                        <th>No KK</th>
                        <th>NIK Kepala Keluarga</th>
                        <th>Alamat</th>
                        <th>RT/RW</th>
                        <th>Kategori</th>
                        <th>Status KK</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($keluargas as $kk)
                        <tr>
                            <td>{{ $kk->nama_kepala_keluarga }}</td>
                            <td>{{ $kk->nomor_kk }}</td>
                            <td>{{ $kk->nik_kepala_keluarga }}</td>
                            <td>{{ $kk->alamat }}</td>
                            <td>{{ $kk->rt }}/{{ $kk->rw }}</td>
                            <td>{{ $kk->kategori_kemiskinan }}</td>
                            <td>
                                <span class="badge {{ $kk->status_badge ?? 'bg-success' }}">
                                    {{ $kk->status_label ?? 'Aktif' }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('keluarga.show', $kk->id) }}" class="btn btn-info btn-sm me-1" title="Detail">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('keluarga.edit', $kk->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="{{ route('keluarga.riwayat-status', $kk->id) }}" class="btn btn-secondary btn-sm me-1" title="Riwayat Status">
                                    <i class="bi bi-clock-history"></i>
                                </a>
                                <form action="{{ route('keluarga.destroy', $kk->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus data ini??')" title="Hapus">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="d-flex flex-column align-items-center">
                                    <i class="bi bi-inbox fs-1 text-muted mb-2"></i>
                                    <h5 class="text-muted">Belum ada data keluarga</h5>
                                    <p class="text-muted mb-0">Silakan tambah data keluarga terlebih dahulu</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Statistik Ringkas (Opsional) -->
        @if($keluargas->count() > 0)
        <div class="row mt-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center">
                        <h4>{{ $keluargas->count() }}</h4>
                        <p class="mb-0">Total Keluarga</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center">
                        <h4>{{ $keluargas->where('status_kk', 'aktif')->count() + $keluargas->whereNull('status_kk')->count() }}</h4>
                        <p class="mb-0">Status Aktif</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center">
                        <h4>{{ $keluargas->where('status_kk', 'pindah')->count() }}</h4>
                        <p class="mb-0">Pindah Alamat</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center">
                        <h4>{{ $keluargas->whereIn('status_kk', ['tidak_aktif', 'meninggal'])->count() }}</h4>
                        <p class="mb-0">Tidak Aktif</p>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
