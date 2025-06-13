<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\BantuanKkController;
use App\Http\Controllers\AnggotaKeluargaController;
use App\Http\Controllers\PetaBantuanController;
use App\Http\Controllers\AboutController;

Route::get('/', function () {
    $jumlahKeluarga = \App\Models\Keluarga::count();
    $jumlahKecamatan = \App\Models\Keluarga::distinct('kecamatan')->count('kecamatan');
    return view('welcome', compact('jumlahKeluarga', 'jumlahKecamatan'));
})->name('dashboard');

// Routes untuk Keluarga dengan fitur update status
Route::resource('keluarga', KeluargaController::class);
Route::put('keluarga/{keluarga}/update-status', [KeluargaController::class, 'updateStatus'])->name('keluarga.update-status');
Route::get('keluarga/{keluarga}/riwayat-status', [KeluargaController::class, 'riwayatStatus'])->name('keluarga.riwayat-status');

// Routes untuk Anggota Keluarga
Route::get('keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'index'])->name('anggota.index');
Route::get('keluarga/{keluarga}/anggota/create', [AnggotaKeluargaController::class, 'create'])->name('anggota.create');
Route::post('keluarga/{keluarga}/anggota', [AnggotaKeluargaController::class, 'store'])->name('anggota.store');
Route::get('anggota/{anggota}', [AnggotaKeluargaController::class, 'show'])->name('anggota.show');
Route::get('anggota/{anggota}/edit', [AnggotaKeluargaController::class, 'edit'])->name('anggota.edit');
Route::put('anggota/{anggota}', [AnggotaKeluargaController::class, 'update'])->name('anggota.update');
Route::delete('anggota/{anggota}', [AnggotaKeluargaController::class, 'destroy'])->name('anggota.destroy');

// Routes untuk Bantuan KK
Route::get('bantuan/create/{keluarga_id}', [BantuanKkController::class, 'create'])->name('bantuan.create');
Route::post('bantuan', [BantuanKkController::class, 'store'])->name('bantuan.store');
Route::get('bantuan/{bantuan}/edit', [BantuanKkController::class, 'edit'])->name('bantuan.edit');
Route::put('bantuan/{bantuan}', [BantuanKkController::class, 'update'])->name('bantuan.update');
Route::delete('bantuan/{bantuan}', [BantuanKkController::class, 'destroy'])->name('bantuan.destroy');
Route::get('bantuan', [BantuanKkController::class, 'index'])->name('bantuan.index');

// Routes untuk WebGIS dan Peta Bantuan
Route::get('/webgis', [KeluargaController::class, 'webgis'])->name('webgis');
Route::prefix('peta-bantuan')->name('peta-bantuan.')->group(function () {
    Route::get('/', [PetaBantuanController::class, 'index'])->name('index');
    Route::get('/statistik', [PetaBantuanController::class, 'statistik'])->name('statistik');
});

// routes untuk About us
Route::get('/about', [AboutController::class, 'index'])->name('about');
