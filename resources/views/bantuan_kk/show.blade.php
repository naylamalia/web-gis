<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th>Tahun Anggaran</th>
            <th>Status</th>
            <th>Nominal</th>
            <th>Tanggal Cair</th>
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
            <td>{{ $bantuan->tanggal_cair ? \Carbon\Carbon::parse($bantuan->tanggal_cair)->format('d/m/Y') : '-' }}</td>
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
