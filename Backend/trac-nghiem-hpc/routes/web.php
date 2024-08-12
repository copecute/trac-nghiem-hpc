<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;

Route::get('/', function () {
    return view('welcome');
});

// Khoa
Route::get('/khoa', [KhoaController::class, 'index'])->name('khoa.index');
Route::get('/khoa/timkiem', [KhoaController::class, 'search'])->name('khoa.search');
Route::get('/khoa/create', [KhoaController::class, 'create'])->name('khoa.create');
Route::post('/khoa', [KhoaController::class, 'store'])->name('khoa.store');
Route::get('/khoa/{id}/edit', [KhoaController::class, 'edit'])->name('khoa.edit');
Route::put('/khoa/{id}', [KhoaController::class, 'update'])->name('khoa.update');
Route::delete('/khoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');

