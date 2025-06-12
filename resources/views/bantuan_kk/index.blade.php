@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Daftar Riwayat Bantuan</h4>
            <a href="{{ route('bantuan.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Bantuan
            </a>
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>No KK</th>
                        <th>Kepala Keluarga</th>
                        <th>Tahun</th>
                        <th>Status</th>
                        <th>Nominal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bantuanKk as $item)
                    <tr>
                        <td>{{ $item->keluarga->nomor_kk }}</td>
                        <td>{{ $item->keluarga->nama_kepala_keluarga }}</td>
                        <td>{{ $item->tahun_anggaran }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td>Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                        <td>
                            <a href="{{ route('bantuan.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('bantuan.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Hapus data bantuan ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">Tidak ada data bantuan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
