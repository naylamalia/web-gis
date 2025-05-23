<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\AnggotaKeluargaController;

Route::get('/', function () {
    $jumlahKeluarga = \App\Models\Keluarga::count();
    $jumlahKecamatan = \App\Models\Keluarga::distinct('kecamatan')->count('kecamatan');
    return view('welcome', compact('jumlahKeluarga', 'jumlahKecamatan'));
})->name('dashboard');

Route::resource('keluarga', KeluargaController::class);

Route::get('keluarga/{keluarga}', [KeluargaController::class, 'show'])->name('keluarga.show');

Route::get('keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'index'])->name('anggota.index');

Route::get('keluarga/{keluarga}/anggota/create', [AnggotaKeluargaController::class, 'create'])->name('anggota.create');

Route::post('keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'store'])->name('anggota.store');

Route::get('anggota/{anggota}/edit', [AnggotaKeluargaController::class, 'edit'])->name('anggota.edit');

Route::put('anggota/{anggota}', [AnggotaKeluargaController::class, 'update'])->name('anggota.update');

Route::delete('anggota/{anggota}', [AnggotaKeluargaController::class, 'destroy'])->name('anggota.destroy');

Route::get('/webgis', [KeluargaController::class, 'webgis'])->name('webgis');

Route::get('anggota/{anggota}', [AnggotaKeluargaController::class, 'show'])->name('anggota.show');
