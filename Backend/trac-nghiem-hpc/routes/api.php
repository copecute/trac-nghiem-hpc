<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\NghanhController;
use App\Http\Middleware\CheckPermission;


// khoa
Route::get('/khoa', [KhoaController::class, 'apiIndex']);
Route::get('/khoa/{id}', [KhoaController::class, 'apiShow']);
// đăng nhập mới đc truy cập
//Route::middleware('auth')->group(function () {
    // có quyền admin mới được truy cập
  //  Route::middleware([CheckPermission::class . ':admin'])->group(function () {
        Route::post('/khoa', [KhoaController::class, 'apiStore']);
        Route::put('/khoa/{id}', [KhoaController::class, 'apiUpdate']);
        Route::delete('/khoa/{id}', [KhoaController::class, 'apiDestroy']);
    //});
    // có quyền user là được truy cập
    //Route::middleware([CheckPermission::class . ':user'])->group(function () {
        Route::get('/khoa?search', [KhoaController::class, 'apiSearch']);
    //});
//});


// Nghành
Route::get('/nghanh', [NghanhController::class, 'apiIndex']);
Route::get('/nghanh/{id}', [NghanhController::class, 'apiShow']);
Route::post('/nghanh', [NghanhController::class, 'apiStore']);
Route::put('/nghanh/{id}', [NghanhController::class, 'apiUpdate']);
Route::delete('/nghanh/{id}', [NghanhController::class, 'apiDestroy']);
Route::get('/nghanh/search', [NghanhController::class, 'apiSearch']);