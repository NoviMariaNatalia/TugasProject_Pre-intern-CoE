<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AuthController;

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/pegawai', [PegawaiController::class, 'index']) -> name('pegawai.index');
Route::get('/pegawai/tambah', [PegawaiController::class, 'tambah']) -> name('pegawai.tambah');
Route::post('/pegawai', [PegawaiController::class, 'store']) -> name('pegawai.store');
Route::get('/pegawai/{id}/edit', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::put('/pegawai/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::delete('/pegawai/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');

Route::post('/insentif/import', [PegawaiController::class, 'importInsentif'])->name('insentif.import');
Route::get('/insentif/export', [PegawaiController::class, 'exportInsentif'])->name('insentif.export');
Route::delete('/insentif', [PegawaiController::class, 'hapusSemuaInsentif'])->name('insentif.destroyAll');


