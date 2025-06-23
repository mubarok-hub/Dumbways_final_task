<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KegiatanController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dasboard');

Route::middleware(['auth'])->group(function () {
    Route::resource('kegiatan', KegiatanController::class);
});