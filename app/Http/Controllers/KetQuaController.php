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
use App\Models\SinhVien;
use App\Models\DeThi;

class KetQuaController extends Controller
{
    // Xem kết quả của sinh viên cho một đề thi qua API
    public function show($sinhvienId, $dethiId)
    {
        // Tìm kết quả của sinh viên với ID và đề thi được chỉ định
        $ketQua = KetQua::where('sinhvien_id', $sinhvienId)
                         ->where('dethi_id', $dethiId)
                         ->first();

        // Nếu không tìm thấy kết quả, trả về thông báo lỗi 404
        if (!$ketQua) {
            return response()->json(['message' => 'Không tìm thấy kết quả.'], 404);
        }

        // Nếu tìm thấy kết quả, trả về dữ liệu kết quả dưới dạng JSON với mã trạng thái 200
        return response()->json($ketQua, 200);
    }

    // Views

    // Hiển thị kết quả của sinh viên cho một đề thi qua giao diện
    public function view($sinhvienId, $dethiId)
    {
        // Tìm kết quả của sinh viên với ID và đề thi được chỉ định
        $ketQua = KetQua::where('sinhvien_id', $sinhvienId)
                         ->where('dethi_id', $dethiId)
                         ->first();

        // Nếu không tìm thấy kết quả, trả về view thông báo không tìm thấy kết quả
        if (!$ketQua) {
            return view('ketqua.notfound');
        }

        // Nếu tìm thấy kết quả, trả về view hiển thị kết quả với dữ liệu kết quả
        return view('ketqua.show', compact('ketQua'));
    }
}