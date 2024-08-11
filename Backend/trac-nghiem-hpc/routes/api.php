<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;

Route::resource('khoa', KhoaController::class);

