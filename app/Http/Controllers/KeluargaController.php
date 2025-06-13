<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\LogPerubahanStatus;
use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeluargaController extends Controller
{
    public function index()
    {
        // Eager load anggota keluarga agar data siap diakses di view index
        $keluargas = Keluarga::with('anggotaKeluarga')->get();
        return view('keluarga.index', compact('keluargas'));
    }

    public function create()
    {
        return view('keluarga.create');
    }

    public function store(StoreKeluargaRequest $request)
    {
        Keluarga::create($request->validated());

        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil ditambahkan');
    }

    public function webgis()
    {
        $keluargas = Keluarga::all(); // Pastikan ada kolom latitude & longitude
        return view('webgis', compact('keluargas'));
    }

    public function show(Keluarga $keluarga)
    {
        // Load relasi anggota keluarga, riwayat bantuan, dan log perubahan status
        $keluarga->load(['anggotaKeluarga', 'bantuanKk', 'logPerubahanStatus']);
        return view('keluarga.show', compact('keluarga'));
    }

    public function edit(Keluarga $keluarga)
    {
        return view('keluarga.edit', compact('keluarga'));
    }

    public function update(UpdateKeluargaRequest $request, Keluarga $keluarga)
    {
        $keluarga->update($request->validated());

        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil diperbarui');
    }

    // Method baru untuk update status KK
    public function updateStatus(Request $request, Keluarga $keluarga)
    {
        $request->validate([
            'status_kk' => 'required|in:aktif,pindah,tidak_miskin,meninggal,tidak_aktif',
            'alasan_perubahan' => 'required|string|max:500',
            'tanggal_perubahan' => 'required|date'
        ]);

        // Simpan status lama untuk log
        $status_lama = $keluarga->status_kk;

        // Update status keluarga
        $keluarga->update([
            'status_kk' => $request->status_kk
        ]);

        // Simpan log perubahan status
        LogPerubahanStatus::create([
            'keluarga_id' => $keluarga->id,
            'status_lama' => $status_lama,
            'status_baru' => $request->status_kk,
            'alasan_perubahan' => $request->alasan_perubahan,
            'tanggal_perubahan' => $request->tanggal_perubahan,
            'user_pengubah' => Auth::user()->name ?? 'System'
        ]);

        return redirect()->route('keluarga.show', $keluarga->id)
            ->with('success', 'Status keluarga berhasil diperbarui');
    }

    // Method untuk melihat riwayat perubahan status
    public function riwayatStatus(Keluarga $keluarga)
    {
        $riwayat = $keluarga->logPerubahanStatus()->orderBy('created_at', 'desc')->get();
        return view('keluarga.riwayat-status', compact('keluarga', 'riwayat'));
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil dihapus');
    }
}
