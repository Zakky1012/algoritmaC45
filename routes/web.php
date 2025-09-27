<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/product', [HomeController::class, 'umkm'])->name('product.index');
Route::get('/umkm/{id}', [HomeController::class, 'show'])->name('umkm.detail');
use App\Http\Controllers\PerusahaanController;

use App\Http\Controllers\KegiatanController;

Route::resource('kegiatan', KegiatanController::class);



Route::resource('perusahaans', PerusahaanController::class);
Route::get('/perusahaan/preprocess', [PerusahaanController::class, 'preprocess'])->name('perusahaans.preprocess');
Route::post('/perusahaans/import', [PerusahaanController::class, 'import'])->name('perusahaans.import');
Route::get('/perusahaan/c45', [PerusahaanController::class, 'hitungc45'])->name('perusahaan.c45');
Route::get('/perusahaan/generate-rules', [PerusahaanController::class, 'generateRules'])->name('perusahaan.generateRules');
Route::delete('/perusahaan/destroy-all', [PerusahaanController::class, 'destroyAll'])
    ->name('perusahaans.destroyAll');




    use App\Http\Controllers\DataUjiController;

Route::prefix('datauji')->group(function () {
    Route::get('/', [DataUjiController::class, 'index'])->name('datauji.index');
    Route::get('/create', [DataUjiController::class, 'create'])->name('datauji.create');
    Route::post('/', [DataUjiController::class, 'store'])->name('datauji.store');
    Route::get('/{datauji}', [DataUjiController::class, 'show'])->name('datauji.show');
    Route::get('/{datauji}/edit', [DataUjiController::class, 'edit'])->name('datauji.edit');
    Route::put('/{datauji}', [DataUjiController::class, 'update'])->name('datauji.update');
    Route::delete('/{datauji}', [DataUjiController::class, 'destroy'])->name('datauji.destroy');
    Route::get('/data-uji/test-rule', [DataUjiController::class, 'testRule'])->name('datauji.testRule');
    // Hapus semua data
    Route::delete('datauji/destroy-all', [DataUjiController::class, 'destroyAll'])->name('datauji.destroyAll');
    Route::post('/import', [DataUjiController::class, 'import'])->name('datauji.import');

});

use App\Http\Controllers\UmkmController;

Route::resource('umkm', UmkmController::class);
Route::post('/umkm/import', [UmkmController::class, 'import'])->name('umkm.import'); 
Route::delete('/usaha/delete-all', [UmkmController::class, 'deleteAll'])->name('umkm.deleteAll');
Route::get('/lihat/labels', [UmkmController::class, 'labels'])->name('umkm.labels');

Route::get('/umkm/data/laporan', [UmkmController::class, 'laporan'])->name('umkm.laporan');
Route::get('/umkm/laporan/export-pdf', [UmkmController::class, 'exportPdf'])->name('umkm.laporan.pdf');
use App\Http\Controllers\AdminController;

Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// routes/web.php
use App\Http\Controllers\AuthController;

// Halaman login (GET)
Route::get('/login', [AuthController::class, 'loginView'])->name('login');

// Proses login (POST)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Halaman register (GET)
Route::get('/register', [AuthController::class, 'registerView'])->name('register');

// Proses register (POST)
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('users', AuthController::class);