<?php

namespace App\Http\Controllers;

use App\Models\BantuanKk;
use App\Models\Keluarga;
use Illuminate\Http\Request;

class BantuanKkController extends Controller
{
    public function create($keluarga_id)
    {
        $keluarga = Keluarga::findOrFail($keluarga_id);
        return view('bantuan_kk.create', compact('keluarga'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'keluarga_id' => 'required|exists:keluargas,id',
            'tahun_anggaran' => 'required|digits:4',
            'status' => 'required|in:aktif,non-aktif',
            'nominal' => 'required|numeric',
            'tanggal_cair' => 'required|date',
        ]);

        BantuanKk::create($request->all());
        return redirect()->route('keluarga.show', $request->keluarga_id)->with('success', 'Data bantuan berhasil ditambahkan');
    }

    public function edit(BantuanKk $bantuan)
    {
        $keluarga = $bantuan->keluarga;
        return view('bantuan_kk.edit', compact('bantuan', 'keluarga'));
    }

    public function update(Request $request, BantuanKk $bantuan)
    {
        $request->validate([
            'tahun_anggaran' => 'required|digits:4',
            'status' => 'required|in:aktif,non-aktif',
            'nominal' => 'required|numeric',
            'tanggal_cair' => 'required|date',
        ]);

        $bantuan->update($request->all());
        return redirect()->route('keluarga.show', $bantuan->keluarga_id)->with('success', 'Data bantuan berhasil diperbarui');
    }

    public function destroy(BantuanKk $bantuan)
    {
        $keluarga_id = $bantuan->keluarga_id;
        $bantuan->delete();
        return redirect()->route('keluarga.show', $keluarga_id)->with('success', 'Data bantuan berhasil dihapus');
    }
}
