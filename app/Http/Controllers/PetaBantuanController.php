<?php

namespace App\Http\Controllers;

use App\Models\Keluarga;
use App\Models\BantuanKk;
use Illuminate\Http\Request;

class PetaBantuanController extends Controller
{
    public function index(Request $request)
    {
        $tahun_filter = $request->get('tahun', date('Y'));
        
        // Ambil semua keluarga dengan relasi bantuan untuk tahun tertentu
        $keluargas = Keluarga::with(['bantuanKk' => function($query) use ($tahun_filter) {
            $query->where('tahun_anggaran', $tahun_filter);
        }])->get();

        // Ambil daftar tahun yang tersedia untuk dropdown filter
        $tahun_tersedia = BantuanKk::selectRaw('DISTINCT tahun_anggaran')
            ->orderBy('tahun_anggaran', 'desc')
            ->pluck('tahun_anggaran');

        // Statistik
        $total_keluarga = $keluargas->count();
        $penerima_bantuan = $keluargas->filter(function($k) {
            return $k->bantuanKk->count() > 0;
        })->count();
        $belum_menerima = $total_keluarga - $penerima_bantuan;

        return view('peta-bantuan.index', compact(
            'keluargas', 
            'tahun_filter', 
            'tahun_tersedia',
            'total_keluarga',
            'penerima_bantuan',
            'belum_menerima'
        ));
    }

    public function statistik(Request $request)
    {
        $tahun_filter = $request->get('tahun', date('Y'));
        
        // Data untuk chart/grafik
        $statistik_per_kecamatan = Keluarga::with(['bantuanKk' => function($query) use ($tahun_filter) {
            $query->where('tahun_anggaran', $tahun_filter);
        }])
        ->selectRaw('kecamatan, COUNT(*) as total_keluarga')
        ->groupBy('kecamatan')
        ->get();

        return view('peta-bantuan.statistik', compact('statistik_per_kecamatan', 'tahun_filter'));
    }
}
