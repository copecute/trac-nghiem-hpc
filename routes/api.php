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
        Route::get('/', [SinhVienController::class, 'apiIndex']); // danh sách sinh viên
        Route::get('/{id}', [SinhVienController::class, 'apiShow']); // chi tiết sinh viên theo ID
        // Route::post('/', [SinhVienController::class, 'apiStore']); // thêm sinh viên
        // Route::put('/{id}', [SinhVienController::class, 'apiUpdate']); // sửa sinh viên
        // Route::delete('/{id}', [SinhVienController::class, 'apiDestroy']); // xoá sinh viên
        Route::get('/search', [SinhVienController::class, 'apiSearch']); // tìm kiếm sinh viên
        
        Route::get('/{sinhvienId}/ketqua/{dethiId}', [KetQuaController::class, 'show'])->name('api.ketqua.show'); // kết quả bài thi
    });

    Route::post('/ketqua', [KetQuaController::class, 'store']); // API thêm kết quả (sinhvien_id sẽ được lấy từ phiên đăng nhập)

    // khoa
    Route::prefix('khoa')->group(function () {
        Route::get('/', [KhoaController::class, 'apiIndex']); // danh sách khoa
        Route::get('/{id}', [KhoaController::class, 'apiShow']); // chi tiết khoa theo ID
        // Route::post('/', [KhoaController::class, 'apiStore']); // thêm khoa
        // Route::put('/{id}', [KhoaController::class, 'apiUpdate']); // sửa khoa
        // Route::delete('/{id}', [KhoaController::class, 'apiDestroy']); // xoá khoa
        Route::get('?search', [KhoaController::class, 'apiSearch']); // tìm kiếm khoa
    });
    
    // Nghành
    Route::prefix('nganh')->group(function () {
        Route::get('/', [NganhController::class, 'apiIndex']); // danh sách ngành
        Route::get('/{id}', [NganhController::class, 'apiShow']); // chi tiết ngành theo ID
        Route::get('?khoa', [NganhController::class, 'apiIndexByKhoa']); // Lấy ngành học theo khoa
        // Route::post('/', [NganhController::class, 'apiStore']); // thêm ngành
        // Route::put('/{id}', [NganhController::class, 'apiUpdate']); // sửa ngành
        // Route::delete('/{id}', [NganhController::class, 'apiDestroy']); // xoá ngành
        Route::get('?search', [NganhController::class, 'apiSearch']); // tìm kiếm ngành
    });
    
    // lớp
    Route::prefix('lop')->group(function () {
        Route::get('/', [LopController::class, 'apiIndex']); // danh sách lớp
        Route::get('/{id}', [LopController::class, 'apiShow']); // chi tiết lớp theo ID
        // Route::post('/', [LopController::class, 'apiStore']); // thêm lớp
        // Route::put('/{id}', [LopController::class, 'apiUpdate']); // sửa lớp
        // Route::delete('/{id}', [LopController::class, 'apiDestroy']); // xoá lớp
        Route::get('?search', [LopController::class, 'apiSearch']); // tìm kiếm lớp
    });
    
    // Môn học
    Route::prefix('monhoc')->group(function () {
        Route::get('/', [MonHocController::class, 'apiIndex']); // danh sách môn học
        Route::get('/{id}', [MonHocController::class, 'apiShow']); // chi tiết môn học theo ID
        // Route::post('/', [MonHocController::class, 'apiStore']); // thêm môn học
        // Route::put('/{id}', [MonHocController::class, 'apiUpdate']); // sửa môn học
        // Route::delete('/{id}', [MonHocController::class, 'apiDestroy']); // xoá môn học
    });
    
    // câu hỏi
    Route::prefix('cauhoi')->group(function () {
        Route::get('/', [CauHoiController::class, 'apiIndex']); // danh sách cấu hỏi
        Route::get('/{id}', [CauHoiController::class, 'apiShow']); // chi tiết cấu hỏi theo ID
        // Route::post('/', [CauHoiController::class, 'apiStore']); // thêm cấu hỏi
        // Route::put('/{id}', [CauHoiController::class, 'apiUpdate']); // sửa cấu hỏi
        // Route::delete('/{id}', [CauHoiController::class, 'apiDestroy']); // xoá cấu hỏi
    });
    
    // đáp án
    Route::prefix('cauhoi')->group(function () {
        Route::get('/{cauHoiId}/dapan', [DapAnController::class, 'apiIndex']); // danh sách đáp án
        Route::get('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiShow']); // chi tiết đáp án theo ID
        // Route::post('/{cauHoiId}/dapan', [DapAnController::class, 'apiStore']); // thêm đáp án
        // Route::put('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiUpdate']); // sửa đáp án
        // Route::delete('/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiDestroy']); // xoá đáp án
    });
    
    // kỳ thi
    Route::prefix('kythi')->group(function () {
        Route::get('/', [KyThiController::class, 'apiIndex']); // danh sách kỳ thi
        Route::get('/{id}', [KyThiController::class, 'apiShow']); // chi tiết kỳ thi theo ID
        // Route::post('/', [KyThiController::class, 'apiStore']); // thêm kỳ thi
        // Route::put('/{id}', [KyThiController::class, 'apiUpdate']); // sửa kỳ thi
        // Route::delete('/{id}', [KyThiController::class, 'apiDestroy']); // xoá kỳ thi
    });
    
    // ca thi
    Route::prefix('kythi')->group(function () {
        Route::get('/{kythi_id}/cathi', [CaThiController::class, 'apiIndex']); // danh sách ca thi
        Route::get('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiShow']); // chi tiết ca thi
        // Route::post('/{kythi_id}/cathi', [CaThiController::class, 'apiStore']); // thêm ca thi
        // Route::put('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiUpdate']); // sửa ca thi
        // Route::delete('/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiDestroy']); // xoá ca thi
    });
    
    // đề thi
    Route::prefix('dethi')->group(function () {
        Route::get('/', [DeThiController::class, 'apiIndex']); // danh sách đề thi
        Route::get('/{id}', [DeThiController::class, 'apiShow']);  // chi tiết đề thi theo ID
        // Route::post('/', [DeThiController::class, 'apiStore']); // thêm đề thi
        // Route::put('/{id}', [DeThiController::class, 'apiUpdate']); // sửa đề thi
        // Route::delete('/{id}', [DeThiController::class, 'apiDestroy']); // xoá đề thi
    });
    
    // phòng thi
    Route::prefix('phongthi')->group(function () {
        Route::get('/', [PhongThiController::class, 'apiIndex']); // danh sách phần thi
        Route::get('/{id}', [PhongThiController::class, 'apiShow']); // chi tiết phần thi theo ID
        // Route::post('/', [PhongThiController::class, 'apiStore']); // thêm phần thi
        // Route::put('/{id}', [PhongThiController::class, 'apiUpdate']); // sửa phần thi
        // Route::delete('/{id}', [PhongThiController::class, 'apiDestroy']); // xoá phần thi
    });

});
