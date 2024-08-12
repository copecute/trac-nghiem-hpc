<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;
use App\Http\Middleware\CheckPermission;

Route::get('/khoa', [KhoaController::class, 'apiIndex']);
Route::get('/khoa/{id}', [KhoaController::class, 'apiShow']);
// đăng nhập mới đc truy cập
Route::middleware('auth')->group(function () {
    // có quyền admin mới được truy cập
    Route::middleware([CheckPermission::class . ':admin'])->group(function () {
        Route::post('/khoa', [KhoaController::class, 'apiStore']);
        Route::put('/khoa/{id}', [KhoaController::class, 'apiUpdate']);
        Route::delete('/khoa/{id}', [KhoaController::class, 'apiDestroy']);
    });
    // có quyền user là được truy cập
    Route::middleware([CheckPermission::class . ':user'])->group(function () {
        Route::get('/khoa?search', [KhoaController::class, 'apiSearch']);
    });
});