<?php
use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Sanctum;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\LopController;
use App\Http\Controllers\SinhVienAuthController;
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
// khoa

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/khoa', [KhoaController::class, 'apiIndex']);
});

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
Route::get('/nganh', [NganhController::class, 'apiIndex']);
Route::get('/nganh/{id}', [NganhController::class, 'apiShow']);
Route::post('/nganh', [NganhController::class, 'apiStore']);
Route::put('/nganh/{id}', [NganhController::class, 'apiUpdate']);
Route::delete('/nganh/{id}', [NganhController::class, 'apiDestroy']);
Route::get('/nganh/search', [NganhController::class, 'apiSearch']);

// lớp
Route::get('/lop', [LopController::class, 'apiIndex']);
Route::get('/lop/timkiem', [LopController::class, 'apiSearch']);
Route::get('/lop/{id}', [LopController::class, 'apiShow']);
Route::post('/lop', [LopController::class, 'apiStore']);
Route::put('/lop/{id}', [LopController::class, 'apiUpdate']);
Route::delete('/lop/{id}', [LopController::class, 'apiDestroy']);


// Môn học
Route::prefix('monhoc')->group(function () {
    Route::get('/', [MonHocController::class, 'apiIndex']);
    Route::get('/{id}', [MonHocController::class, 'apiShow']);
    Route::post('/', [MonHocController::class, 'apiStore']);
    Route::put('/{id}', [MonHocController::class, 'apiUpdate']);
    Route::delete('/{id}', [MonHocController::class, 'apiDestroy']);
});

// câu hỏi
Route::get('/cauhoi', [CauHoiController::class, 'apiIndex']);
Route::get('/cauhoi/{id}', [CauHoiController::class, 'apiShow']);
Route::post('/cauhoi', [CauHoiController::class, 'apiStore']);
Route::put('/cauhoi/{id}', [CauHoiController::class, 'apiUpdate']);
Route::delete('/cauhoi/{id}', [CauHoiController::class, 'apiDestroy']);

// đáp án
Route::get('/cauhoi/{cauHoiId}/dapan', [DapAnController::class, 'apiIndex']);
Route::get('/cauhoi/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiShow']);
Route::post('/cauhoi/{cauHoiId}/dapan', [DapAnController::class, 'apiStore']);
Route::put('/cauhoi/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiUpdate']);
Route::delete('/cauhoi/{cauHoiId}/dapan/{id}', [DapAnController::class, 'apiDestroy']);

// kỳ thi
Route::prefix('kythi')->group(function () {
    Route::get('/', [KyThiController::class, 'apiIndex']);
    Route::get('/{id}', [KyThiController::class, 'apiShow']);
    Route::post('/', [KyThiController::class, 'apiStore']);
    Route::put('/{id}', [KyThiController::class, 'apiUpdate']);
    Route::delete('/{id}', [KyThiController::class, 'apiDestroy']);
});

// ca thi
Route::get('/kythi/{kythi_id}/cathi', [CaThiController::class, 'apiIndex']);
Route::post('/kythi/{kythi_id}/cathi', [CaThiController::class, 'apiStore']);
Route::get('/kythi/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiShow']);
Route::put('/kythi/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiUpdate']);
Route::delete('/kythi/{kythi_id}/cathi/{id}', [CaThiController::class, 'apiDestroy']);

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

// kết quả
Route::get('/sinhvien/{sinhvienId}/ketqua/{dethiId}', [KetQuaController::class, 'show'])->name('api.ketqua.show');
