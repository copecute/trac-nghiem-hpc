<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckPermission;

Route::get('/', function () {
    return view('welcome');
});

// admin login 
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Khoa
Route::get('/khoa', [KhoaController::class, 'index'])->name('khoa.index');

// Login và có quyền admin
Route::middleware(['auth', CheckPermission::class . ':admin'])->group(function () {
    Route::get('/khoa/create', [KhoaController::class, 'create'])->name('khoa.create');
    Route::get('/khoa/{id}/edit', [KhoaController::class, 'edit'])->name('khoa.edit');
    Route::post('/khoa', [KhoaController::class, 'store'])->name('khoa.store');
    Route::put('/khoa/{id}', [KhoaController::class, 'update'])->name('khoa.update');
    Route::delete('/khoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');

    Route::get('/khoa/timkiem', [KhoaController::class, 'search'])->name('khoa.search');
});

