<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/profil/ubah', [ProfilController::class, 'ubah'])->name('profil.ubah');
    Route::post('/profil/update', [ProfilController::class, 'update'])->name('profil.update');

    Route::resource('kegiatan', KegiatanController::class);
});