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
use App\Models\KetQua;
use App\Models\DeThi;
use Illuminate\Support\Facades\Auth;

class KetQuaController extends Controller
{
    // Xem kết quả của sinh viên cho một đề thi qua API
    public function show($sinhvienId, $dethiId)
    {
        $ketQua = KetQua::where('sinhvien_id', $sinhvienId)
                         ->where('dethi_id', $dethiId)
                         ->first();

        if (!$ketQua) {
            return response()->json(['message' => 'Không tìm thấy kết quả.'], 404);
        }

        return response()->json($ketQua, 200);
    }

    // Thêm kết quả qua API
    public function store(Request $request)
    {
        // Lấy sinh viên từ token đăng nhập (Sanctum)
        $sinhVien = Auth::guard('sanctum')->user();

        if (!$sinhVien) {
            return response()->json(['message' => 'Không tìm thấy sinh viên đã đăng nhập.'], 401);
        }

        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'diemSo' => 'required|numeric|min:0|max:10',  // Kiểm tra điểm số là số và nằm trong khoảng 0-10
            'danhSachDapAn' => 'required|json',            // Đáp án phải là JSON hợp lệ
            'dethi_id' => 'required|exists:tb_dethi,id',   // Đề thi phải tồn tại
        ]);

        // Tạo mới kết quả và lưu vào cơ sở dữ liệu
        $ketQua = KetQua::create([
            'diemSo' => $request->diemSo,
            'danhSachDapAn' => $request->danhSachDapAn,
            'dethi_id' => $request->dethi_id,
            'sinhvien_id' => $sinhVien->id, // Chèn sinhvien_id từ sinh viên đã đăng nhập
        ]);

        // Trả về kết quả vừa được thêm với mã trạng thái 201
        return response()->json(['message' => 'Kết quả đã được lưu thành công.', 'ketQua' => $ketQua], 201);
    }
}