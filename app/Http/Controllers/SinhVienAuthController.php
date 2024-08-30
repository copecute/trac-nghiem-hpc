<?php
//                       _oo0oo_
//                      o8888888o
//                      88" . "88
//                      (| -_- |)
//                      0\  =  /0
//                    ___/`---'\___
//                  .' \\|     |// '.
//                 / \\|||  :  |||// \
//                / _||||| -:- |||||- \
//               |   | \\\  -  /// |   |
//               | \_|  ''\---/''  |_/ |
//               \  .-\__  '-'  ___/-. /
//             ___'. .'  /--.--\  `. .'___
//          ."" '<  `.___\_<|>_/___.' >' "".
//         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
//         \  \ `_.   \_ __\ /__ _/   .-` /  /
//     =====`-.____`.___ \_____/___.-`___.-'=====
//                       `=---='
//
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//            amen đà phật, không bao giờ BUG
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SinhVien;
use App\Models\Lop;
use App\Models\Nganh;
use App\Models\Khoa;
use Illuminate\Support\Facades\Hash;

class SinhVienAuthController extends Controller
{
    // Phương thức xử lý đăng nhập của sinh viên
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:255', // 'maSV' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'matKhau' => 'required', // 'matKhau' là bắt buộc
        ]);
    
        // Tìm sinh viên theo mã sinh viên
        $sinhVien = SinhVien::where('maSV', $request->maSV)->first();
    
        // Kiểm tra xem sinh viên có tồn tại
        if (!$sinhVien || !Hash::check($request->matKhau, $sinhVien->matKhau)) {
            // nếu không tìm thấy maSV hoặc mk không chính xác, trả về thông báo lỗi chung
            return response()->json(['message' => 'Tài khoản hoặc mật khẩu không hợp lệ'], 401);
        }
    
        // Lấy thông tin chi tiết lớp, ngành, khoa của sinh viên
        $lop = Lop::find($sinhVien->lop_id);
        $nganh = Nganh::find($lop->nganh_id);
        $khoa = Khoa::find($nganh->khoa_id);
    
        // Tạo token
        $token = $sinhVien->createToken('copecute!~', [], now()->addHours(5))->plainTextToken;
    
        // Trả về thông báo thành công cùng với token và thông tin chi tiết
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'maSV' => $sinhVien->maSV,
            'hoTen' => $sinhVien->hoTen,
            'maLop' => $lop->maLop,
            'tenLop' => $lop->tenLop,
            'maNganh' => $nganh->maNganh,
            'tenNganh' => $nganh->tenNganh,
            'maKhoa' => $khoa->maKhoa,
            'tenKhoa' => $khoa->tenKhoa,
            'token' => $token,
        ]);
    }
}
