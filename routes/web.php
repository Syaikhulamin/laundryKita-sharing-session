<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PelangganController;

Route::get('/', [HomeController::class, 'index'])->name('dashboard');

Route::get('/layanan', [LayananController::class, 'index'])->name('layanan.index');
Route::get('/layanan/create', [LayananController::class, 'create'])->name('layanan.create');
Route::post('/layanan/store', [LayananController::class, 'store'])->name('layanan.store');
Route::get('/layanan/edit/{id}', [LayananController::class, 'edit'])->name('layanan.edit');
Route::post('/layanan/update/{id}', [LayananController::class, 'update'])->name('layanan.update');
Route::post('/layanan/destroy/{id}', [LayananController::class, 'destroy'])->name('layanan.destroy');

Route::resource('/pelanggan', PelangganController::class);