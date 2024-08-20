<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckPermission;
use App\Http\Controllers\KhoaController;
use App\Http\Controllers\NganhController;
use App\Http\Controllers\LopController;
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

Route::get('/dashboard', function () {
    return view('dashboard.index');
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
// Route::middleware(['auth', CheckPermission::class . ':admin'])->group(function () {
    Route::get('/khoa/create', [KhoaController::class, 'create'])->name('khoa.create');
    Route::get('/khoa/{id}/edit', [KhoaController::class, 'edit'])->name('khoa.edit');
    Route::post('/khoa', [KhoaController::class, 'store'])->name('khoa.store');
    Route::put('/khoa/{id}', [KhoaController::class, 'update'])->name('khoa.update');
    Route::delete('/khoa/{id}', [KhoaController::class, 'destroy'])->name('khoa.destroy');

    Route::get('/khoa/timkiem', [KhoaController::class, 'search'])->name('khoa.search');
//});

// Nghành
Route::get('/nganh', [NganhController::class, 'index'])->name('nganh.index');
Route::get('/nganh/search', [NganhController::class, 'search'])->name('nganh.search');
Route::get('/nganh/create', [NganhController::class, 'create'])->name('nganh.create');
Route::post('/nganh', [NganhController::class, 'store'])->name('nganh.store');
Route::get('/nganh/{id}/edit', [NganhController::class, 'edit'])->name('nganh.edit');
Route::put('/nganh/{id}', [NganhController::class, 'update'])->name('nganh.update');
Route::delete('/nganh/{id}', [NganhController::class, 'destroy'])->name('nganh.destroy');

// lớp
Route::get('/lop', [LopController::class, 'index'])->name('lop.index');
Route::get('/lop/timkiem', [LopController::class, 'search'])->name('lop.search');
Route::get('/lop/create', [LopController::class, 'create'])->name('lop.create');
Route::post('/lop', [LopController::class, 'store'])->name('lop.store');
Route::get('/lop/{id}/edit', [LopController::class, 'edit'])->name('lop.edit');
Route::put('/lop/{id}', [LopController::class, 'update'])->name('lop.update');
Route::delete('/lop/{id}', [LopController::class, 'destroy'])->name('lop.destroy');

// Sinh viên
Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
Route::get('/sinhvien/search', [SinhVienController::class, 'search'])->name('sinhvien.search');
Route::get('/sinhvien/create', [SinhVienController::class, 'create'])->name('sinhvien.create');
Route::post('/sinhvien', [SinhVienController::class, 'store'])->name('sinhvien.store');
Route::get('/sinhvien/{id}/edit', [SinhVienController::class, 'edit'])->name('sinhvien.edit');
Route::put('/sinhvien/{id}', [SinhVienController::class, 'update'])->name('sinhvien.update');
Route::delete('/sinhvien/{id}', [SinhVienController::class, 'destroy'])->name('sinhvien.destroy');

// Môn học
Route::get('/monhoc', [MonHocController::class, 'index'])->name('monhoc.index');
Route::get('/monhoc/search', [MonHocController::class, 'search'])->name('monhoc.search');
Route::get('/monhoc/create', [MonHocController::class, 'create'])->name('monhoc.create');
Route::post('/monhoc', [MonHocController::class, 'store'])->name('monhoc.store');
Route::get('/monhoc/{id}/edit', [MonHocController::class, 'edit'])->name('monhoc.edit');
Route::put('/monhoc/{id}', [MonHocController::class, 'update'])->name('monhoc.update');
Route::delete('/monhoc/{id}', [MonHocController::class, 'destroy'])->name('monhoc.destroy');

// câu hỏi
Route::get('/cauhoi', [CauHoiController::class, 'index'])->name('cauhoi.index');
Route::get('/cauhoi/search', [CauHoiController::class, 'search'])->name('cauhoi.search');
Route::get('/cauhoi/create', [CauHoiController::class, 'create'])->name('cauhoi.create');
Route::post('/cauhoi', [CauHoiController::class, 'store'])->name('cauhoi.store');
Route::get('/cauhoi/{id}/edit', [CauHoiController::class, 'edit'])->name('cauhoi.edit');
Route::put('/cauhoi/{id}', [CauHoiController::class, 'update'])->name('cauhoi.update');
Route::delete('/cauhoi/{id}', [CauHoiController::class, 'destroy'])->name('cauhoi.destroy');

// đáp án
Route::get('/cauhoi/{cauHoiId}/dapan', [DapAnController::class, 'index'])->name('dapan.index');
Route::get('/cauhoi/{cauHoiId}/dapan/create', [DapAnController::class, 'create'])->name('dapan.create');
Route::post('/cauhoi/{cauHoiId}/dapan', [DapAnController::class, 'store'])->name('dapan.store');
Route::get('/cauhoi/{cauHoiId}/dapan/{id}/edit', [DapAnController::class, 'edit'])->name('dapan.edit');
Route::put('/cauhoi/{cauHoiId}/dapan/{id}', [DapAnController::class, 'update'])->name('dapan.update');
Route::delete('/cauhoi/{cauHoiId}/dapan/{id}', [DapAnController::class, 'destroy'])->name('dapan.destroy');

// kỳ thi
Route::get('/kythi', [KyThiController::class, 'index'])->name('kythi.index');
Route::get('/kythi/search', [KyThiController::class, 'search'])->name('kythi.search');
Route::get('/kythi/create', [KyThiController::class, 'create'])->name('kythi.create');
Route::post('/kythi', [KyThiController::class, 'store'])->name('kythi.store');
Route::get('/kythi/{id}/edit', [KyThiController::class, 'edit'])->name('kythi.edit');
Route::put('/kythi/{id}', [KyThiController::class, 'update'])->name('kythi.update');
Route::delete('/kythi/{id}', [KyThiController::class, 'destroy'])->name('kythi.destroy');

// ca thi
Route::get('/kythi/{kythi_id}/cathi', [CaThiController::class, 'index'])->name('cathi.index');
Route::get('/kythi/{kythi_id}/cathi/create', [CaThiController::class, 'create'])->name('cathi.create');
Route::post('/kythi/{kythi_id}/cathi', [CaThiController::class, 'store'])->name('cathi.store');
Route::get('/kythi/{kythi_id}/cathi/{id}/edit', [CaThiController::class, 'edit'])->name('cathi.edit');
Route::put('/kythi/{kythi_id}/cathi/{id}', [CaThiController::class, 'update'])->name('cathi.update');
Route::delete('/kythi/{kythi_id}/cathi/{id}', [CaThiController::class, 'destroy'])->name('cathi.destroy');

// đề thi
Route::get('/dethi', [DeThiController::class, 'index'])->name('dethi.index');
Route::get('/dethi/create', [DeThiController::class, 'create'])->name('dethi.create');
Route::post('/dethi', [DeThiController::class, 'store'])->name('dethi.store');
Route::get('/dethi/{id}/edit', [DeThiController::class, 'edit'])->name('dethi.edit');
Route::put('/dethi/{id}', [DeThiController::class, 'update'])->name('dethi.update');
Route::delete('/dethi/{id}', [DeThiController::class, 'destroy'])->name('dethi.destroy');

// phòng thi
Route::prefix('phongthi')->group(function () {
    Route::get('/', [PhongThiController::class, 'index'])->name('phongthi.index');
    Route::get('/create', [PhongThiController::class, 'create'])->name('phongthi.create');
    Route::post('/', [PhongThiController::class, 'store'])->name('phongthi.store');
    Route::get('/{id}/edit', [PhongThiController::class, 'edit'])->name('phongthi.edit');
    Route::put('/{id}', [PhongThiController::class, 'update'])->name('phongthi.update');
    Route::delete('/{id}', [PhongThiController::class, 'destroy'])->name('phongthi.destroy');
});

// kết quả
Route::get('/sinhvien/{sinhvienId}/ketqua/{dethiId}', [KetQuaController::class, 'view'])->name('ketqua.view');
