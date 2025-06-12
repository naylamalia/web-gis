<form action="{{ isset($bantuan) ? route('bantuan.update', $bantuan->id) : route('bantuan.store') }}" method="POST">
    @csrf
    @if(isset($bantuan))
        @method('PUT')
    @endif

    <input type="hidden" name="keluarga_id" value="{{ $keluarga->id ?? $bantuan->keluarga_id }}">

    <div class="mb-3">
        <label>Tahun Anggaran</label>
        <input type="number" name="tahun_anggaran" class="form-control"
               value="{{ old('tahun_anggaran', $bantuan->tahun_anggaran ?? date('Y')) }}" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control" required>
            <option value="aktif" {{ (old('status', $bantuan->status ?? '') == 'aktif') ? 'selected' : '' }}>Aktif</option>
            <option value="non-aktif" {{ (old('status', $bantuan->status ?? '') == 'non-aktif') ? 'selected' : '' }}>Non-Aktif</option>
        </select>
    </div>

    <div class="mb-3">
        <label>Nominal</label>
        <input type="number" name="nominal" class="form-control"
               value="{{ old('nominal', $bantuan->nominal ?? '') }}" required>
    </div>

    <button type="submit" class="btn btn-success">{{ isset($bantuan) ? 'Perbarui' : 'Simpan' }}</button>
    <a href="{{ route('keluarga.show', $keluarga->id ?? $bantuan->keluarga_id) }}" class="btn btn-secondary">Kembali</a>
</form>
