@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4><i class="bi bi-clock-history"></i> Riwayat Perubahan Status - {{ $keluarga->nama_kepala_keluarga }}</h4>
            <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali ke Detail
            </a>
        </div>
        <div class="card-body">
            <!-- Info Keluarga -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Informasi Keluarga</h6>
                            <p class="mb-1"><strong>No KK:</strong> {{ $keluarga->nomor_kk }}</p>
                            <p class="mb-1"><strong>NIK Kepala Keluarga:</strong> {{ $keluarga->nik_kepala_keluarga }}</p>
                            <p class="mb-1"><strong>Alamat:</strong> {{ $keluarga->alamat }}</p>
                            <p class="mb-0"><strong>RT/RW:</strong> {{ $keluarga->rt }}/{{ $keluarga->rw }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h6 class="card-title">Status Saat Ini</h6>
                            <h3 class="mb-0">
                                <span class="badge bg-light text-dark fs-6">
                                    {{ $keluarga->status_label ?? 'Aktif' }}
                                </span>
                            </h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistik Perubahan -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card bg-info text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-arrow-repeat fs-1"></i>
                            <h4 class="mt-2">{{ $riwayat->count() }}</h4>
                            <p class="mb-0">Total Perubahan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-calendar-check fs-1"></i>
                            <h4 class="mt-2">{{ $riwayat->first()?->tanggal_perubahan?->format('d/m/Y') ?? '-' }}</h4>
                            <p class="mb-0">Perubahan Terakhir</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <i class="bi bi-person-check fs-1"></i>
                            <h4 class="mt-2">{{ $riwayat->first()?->user_pengubah ?? '-' }}</h4>
                            <p class="mb-0">Diubah Oleh</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Riwayat -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-table"></i> Detail Riwayat Perubahan Status</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th width="10%">No</th>
                                    <th width="15%">Tanggal</th>
                                    <th width="15%">Status Lama</th>
                                    <th width="15%">Status Baru</th>
                                    <th width="30%">Alasan Perubahan</th>
                                    <th width="15%">Diubah Oleh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($riwayat as $index => $log)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold">{{ $log->tanggal_perubahan->format('d/m/Y') }}</span>
                                            <small class="text-muted">{{ $log->created_at->format('H:i') }}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @if($log->status_lama)
                                            @php
                                                $statusLamaClass = match($log->status_lama) {
                                                    'aktif' => 'bg-success',
                                                    'pindah' => 'bg-warning',
                                                    'tidak_miskin' => 'bg-info',
                                                    'meninggal' => 'bg-dark',
                                                    'tidak_aktif' => 'bg-danger',
                                                    default => 'bg-secondary'
                                                };
                                            @endphp
                                            <span class="badge {{ $statusLamaClass }}">
                                                {{ ucwords(str_replace('_', ' ', $log->status_lama)) }}
                                            </span>
                                        @else
                                            <span class="text-muted fst-italic">Status Awal</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $statusBaruClass = match($log->status_baru) {
                                                'aktif' => 'bg-success',
                                                'pindah' => 'bg-warning',
                                                'tidak_miskin' => 'bg-info',
                                                'meninggal' => 'bg-dark',
                                                'tidak_aktif' => 'bg-danger',
                                                default => 'bg-secondary'
                                            };
                                        @endphp
                                        <span class="badge {{ $statusBaruClass }}">
                                            {{ ucwords(str_replace('_', ' ', $log->status_baru)) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="text-wrap" style="max-width: 250px;">
                                            {{ $log->alasan_perubahan }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-person-circle me-2"></i>
                                            <span>{{ $log->user_pengubah }}</span>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="bi bi-inbox fs-1 text-muted mb-2"></i>
                                            <h5 class="text-muted">Belum Ada Riwayat Perubahan</h5>
                                            <p class="text-muted mb-0">Status keluarga ini belum pernah diubah</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Timeline View (Opsional untuk tampilan yang lebih menarik) -->
            @if($riwayat->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0"><i class="bi bi-clock"></i> Timeline Perubahan Status</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        @foreach($riwayat as $log)
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0">
                                        Status diubah menjadi 
                                        <span class="badge bg-primary">{{ ucwords(str_replace('_', ' ', $log->status_baru)) }}</span>
                                    </h6>
                                    <small class="text-muted">{{ $log->tanggal_perubahan->format('d M Y') }}</small>
                                </div>
                                <p class="mb-1">{{ $log->alasan_perubahan }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-person"></i> {{ $log->user_pengubah }} • 
                                    <i class="bi bi-clock"></i> {{ $log->created_at->format('H:i') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('keluarga.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-list"></i> Daftar Keluarga
                </a>
                <div>
                    <a href="{{ route('keluarga.edit', $keluarga->id) }}" class="btn btn-warning me-2">
                        <i class="bi bi-pencil"></i> Edit Data Keluarga
                    </a>
                    <a href="{{ route('keluarga.show', $keluarga->id) }}" class="btn btn-primary">
                        <i class="bi bi-eye"></i> Detail Keluarga
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Custom CSS untuk Timeline */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 15px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: #dee2e6;
}

.timeline-item {
    position: relative;
    margin-bottom: 30px;
}

.timeline-marker {
    position: absolute;
    left: -37px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 3px solid #fff;
    box-shadow: 0 0 0 3px #dee2e6;
}

.timeline-content {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #0d6efd;
}

.timeline-item:last-child {
    margin-bottom: 0;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .timeline {
        padding-left: 20px;
    }
    
    .timeline-marker {
        left: -27px;
    }
}
</style>
@endsection
