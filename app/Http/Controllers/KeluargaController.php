<?php


namespace App\Http\Controllers;


use App\Models\Keluarga;
use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;


class KeluargaController extends Controller
{
    public function index()
    {
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
        $keluarga->load('anggotaKeluarga');
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


    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();
        return redirect()->route('keluarga.index')->with('success', 'Data keluarga berhasil dihapus');
    }
}

