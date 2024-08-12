<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;

Route::get('/khoa', [KhoaController::class, 'apiIndex']);
Route::get('/khoa/timkiem', [KhoaController::class, 'apiSearch']);
Route::get('/khoa/{id}', [KhoaController::class, 'apiShow']);
Route::middleware('auth')->group(function () {
Route::post('/khoa', [KhoaController::class, 'apiStore']);
Route::put('/khoa/{id}', [KhoaController::class, 'apiUpdate']);
Route::delete('/khoa/{id}', [KhoaController::class, 'apiDestroy']);
});


