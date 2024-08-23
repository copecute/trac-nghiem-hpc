<?php
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\ApiAuthenticate;

use App\Http\Controllers\KhoaController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\SinhVienAuthController;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\MonHocController;
use App\Http\Controllers\CauHoiController;
use App\Http\Controllers\DapAnController;
use App\Http\Controllers\KyThiController;
use App\Http\Controllers\CaThiController;
use App\Http\Controllers\DeThiController;
use App\Http\Controllers\KetQuaController;
use App\Http\Controllers\PhongThiController;


Route::get('/', function () {
    return view('index');
});

// Route đăng nhập cho sinh viên
Route::post('/sinhvien/login', [SinhVienAuthController::class, 'login']);

// xác thực bằng middleware auth:sanctum
Route::middleware([ApiAuthenticate::class])->group(function () {
    // Sinh viên
    Route::prefix('sinhvien')->group(function () {
        Route::get('/', [SinhVienController::class, 'apiIndex']);
        Route::get('/{id}', [SinhVienController::class, 'apiShow']);
        Route::post('/', [SinhVienController::class, 'apiStore']);
        Route::put('/{id}', [SinhVienController::class, 'apiUpdate']);
        Route::delete('/{id}', [SinhVienController::class, 'apiDestroy']);
        Route::get('/search', [SinhVienController::class, 'apiSearch']);
        
        // kết quả
        Route::get('/{sinhvienId}/ketqua/{dethiId}', [KetQuaController::class, 'show'])->name('api.ketqua.show');
    });

    // khoa
    Route::prefix('khoa')->group(function () {
        Route::get('/', [KhoaController::class, 'apiIndex']);
        Route::get('//{id}', [KhoaController::class, 'apiShow']);
        Route::post('/', [KhoaController::class, 'apiStore']);
        Route::put('/{id}', [KhoaController::class, 'apiUpdate']);
        Route::delete('/{id}', [KhoaController::class, 'apiDestroy']);
        Route::get('?search', [KhoaController::class, 'apiSearch']);
    });
    
    // Nghành
    Route::prefix('nganh')->group(function () {
        Route::get('/', [NganhController::class, 'apiIndex']);
        Route::get('/{id}', [NganhController::class, 'apiShow']);
        Route::post('/', [NganhController::class, 'apiStore']);
        Route::put('/{id}', [NganhController::class, 'apiUpdate']);
        Route::delete('/{id}', [NganhController::class, 'apiDestroy']);
        Route::get('?search', [NganhController::class, 'apiSearch']);
    });
    
    // lớp
    Route::prefix('lop')->group(function () {
        Route::get('/', [LopController::class, 'apiIndex']);
        Route::get('/timkiem', [LopController::class, 'apiSearch']);
        Route::get('/{id}', [LopController::class, 'apiShow']);
        Route::post('/', [LopController::class, 'apiStore']);
        Route::put('/{id}', [LopController::class, 'apiUpdate']);
        Route::delete('/{id}', [LopController::class, 'apiDestroy']);
    });
    
    // Môn học
    Route::prefix('monhoc')->group(function () {
        Route::get('/', [MonHocController::class, 'apiIndex']);
        Route::get('/{id}', [MonHocController::class, 'apiShow']);
        Route::post('/', [MonHocController::class, 'apiStore']);
        Route::put('/{id}', [MonHocController::class, 'apiUpdate']);
        Route::delete('/{id}', [MonHocController::class, 'apiDestroy']);
    });
    
    // câu hỏi
    Route::prefix('cauhoi')->group(function () {
        Route::get('/', [CauHoiController::class, 'apiIndex']);
        Route::get('/{id}', [CauHoiController::class, 'apiShow']);
        Route::post('/', [CauHoiController::class, 'apiStore']);
        Route::put('/{id}', [CauHoiController::class, 'apiUpdate']);
        Route::delete('/{id}', [CauHoiController::class, 'apiDestroy']);
    });
    
    // đáp án
    Route::prefix('cauhoi')->group(function () {
        Route::get('/{cauHoiId}/dapan', [DapAnController::class, 'apiIndex']);
        Route::get('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiShow']);
        Route::post('/{cauHoiId}/dapan', [DapAnController::class, 'apiStore']);
        Route::put('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiUpdate']);
        Route::delete('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiDestroy']);
    });
    
    // kỳ thi
    Route::prefix('kythi')->group(function () {
        Route::get('/', [KyThiController::class, 'apiIndex']);
        Route::get('/{id}', [KyThiController::class, 'apiShow']);
        Route::post('/', [KyThiController::class, 'apiStore']);
        Route::put('/{id}', [KyThiController::class, 'apiUpdate']);
        Route::delete('/{id}', [KyThiController::class, 'apiDestroy']);
    });
    
    // ca thi
    Route::prefix('kythi')->group(function () {
        Route::get('/{kythi_id}/cathi', [CaThiController::class, 'apiIndex']);
        Route::post('/{kythi_id}/cathi', [CaThiController::class, 'apiStore']);
        Route::get('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiShow']);
        Route::put('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiUpdate']);
        Route::delete('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiDestroy']);
    });
    
    // đề thi
    Route::prefix('dethi')->group(function () {
        Route::get('/', [DeThiController::class, 'apiIndex']);
        Route::get('/{id}', [DeThiController::class, 'apiShow']);
        Route::post('/', [DeThiController::class, 'apiStore']);
        Route::put('/{id}', [DeThiController::class, 'apiUpdate']);
        Route::delete('/{id}', [DeThiController::class, 'apiDestroy']);
    });
    
    // phòng thi
    Route::prefix('phongthi')->group(function () {
        Route::get('/', [PhongThiController::class, 'apiIndex']);
        Route::get('/{id}', [PhongThiController::class, 'apiShow']);
        Route::post('/', [PhongThiController::class, 'apiStore']);
        Route::put('/{id}', [PhongThiController::class, 'apiUpdate']);
        Route::delete('/{id}', [PhongThiController::class, 'apiDestroy']);
    });

});
