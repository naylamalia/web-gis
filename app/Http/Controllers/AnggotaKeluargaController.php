<?php

namespace App\Http\Controllers;

use App\Models\AnggotaKeluarga;
use App\Models\Keluarga;
use App\Http\Requests\StoreAnggotaKeluargaRequest;
use App\Http\Requests\UpdateAnggotaKeluargaRequest;

class AnggotaKeluargaController extends Controller
{

    public function index($keluarga_id)
    {
        $keluarga = Keluarga::findOrFail($keluarga_id);
        $anggotaList = $keluarga->anggotaKeluarga ?? collect(); 

        return view('anggota.index', compact('keluarga', 'anggotaList'));
    }

    public function create($keluarga)
    {
        $keluarga = Keluarga::findOrFail($keluarga);
        return view('anggota.create', compact('keluarga'));
    }

    public function store(StoreAnggotaKeluargaRequest $request, $keluarga)
    {
        $data = $request->validated();
        $data['keluarga_id'] = $keluarga;
        AnggotaKeluarga::create($data);

        return redirect()->route('keluarga.show', $keluarga)->with('success', 'Data anggota berhasil ditambahkan');
    }

    public function show(AnggotaKeluarga $anggota)
    {
     
        $keluarga = $anggota->keluarga; 

        return view('anggota.show', compact('anggota', 'keluarga'));
    }

    public function edit(AnggotaKeluarga $anggota)
    {
        $keluargas = Keluarga::all();
        return view('anggota.edit', compact('anggota', 'keluargas'));
    }

    public function update(UpdateAnggotaKeluargaRequest $request, AnggotaKeluarga $anggota)
    {
        $anggota->update($request->validated());

        return redirect()->route('keluarga.show', $anggota->keluarga_id)->with('success', 'Data anggota berhasil diperbarui');
    }

    public function destroy(AnggotaKeluarga $anggota)
    {
        $keluargaId = $anggota->keluarga_id;
        $anggota->delete();
        return redirect()->route('keluarga.show', $keluargaId)->with('success', 'Data anggota berhasil dihapus');
    }
}
