<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeluargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // karena tidak pakai auth
    }

    public function rules(): array
    {
        return [
            'nomor_kk' => 'required|unique:keluargas',
            'nik_kepala_keluarga' => 'required',
            'nama_kepala_keluarga' => 'required|string|max:255',
            'alamat' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'rt' => 'required|string|max:5',
            'rw' => 'required|string|max:5',
            'desa' => 'required|string|max:100',
            'kecamatan' => 'required|string|max:100',
            'kategori_kemiskinan' => 'required|in:rentan miskin,miskin,menuju kelas menengah,kelas menengah, kelas atas',
            'bantuan' => 'nullable|string|max:255',
        ];
    }
}