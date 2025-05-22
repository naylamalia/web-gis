<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnggotaKeluargaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keluarga_id' => 'required|exists:keluargas,id',
            'nik' => 'required|string|unique:anggota_keluargas,nik',
            'nama' => 'required|string|max:255',
            'usia' => 'required|integer|min:0',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'hubungan_dengan_kepala' => 'required|string|max:100',
            'pekerjaan' => 'nullable|string|max:100',
            'tempat_lahir' => 'nullable|string|max:100',
            'tanggal_lahir' => 'nullable|date',
            'pendidikan_terakhir' => 'nullable|in:Tidak Sekolah,SD,SMP,SMA,Diploma,S1,S2,S3',
            'status_perkawinan' => 'nullable|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'nullable|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu,Lainnya',
            'kewarganegaraan' => 'nullable|in:Indonesia,Asing',
            'penghasilan' => 'nullable|numeric',
            'bpjs' => 'nullable|boolean',
        ];
    }
}