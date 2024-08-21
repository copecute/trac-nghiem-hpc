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
use Illuminate\Support\Facades\Hash;

class SinhVienAuthController extends Controller
{
    // Phương thức xử lý đăng nhập của sinh viên
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:10|exists:tb_SinhVien,maSV', // 'maSV' là bắt buộc, phải là chuỗi, tối đa 10 ký tự và phải tồn tại trong bảng 'tb_SinhVien'
            'matKhau' => 'required', // 'matKhau' là bắt buộc
        ]);
    
        // Tìm sinh viên theo mã sinh viên
        $sinhVien = SinhVien::where('maSV', $request->maSV)->first();
    
        // Kiểm tra xem sinh viên có tồn tại và mật khẩu có đúng không
        if (!$sinhVien || !Hash::check($request->matKhau, $sinhVien->matKhau)) {
            // Nếu thông tin không hợp lệ, trả về thông báo lỗi với mã trạng thái 401 (Unauthorized)
            return response()->json(['message' => 'Thông tin đăng nhập không hợp lệ'], 401);
        }
    
        // Tạo token cho sinh viên và trả về
        $token = $sinhVien->createToken('copecuteHPC')->plainTextToken;
    
        // Trả về thông báo thành công cùng với token
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'token' => $token,
        ]);
    }
}