<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KetQua;
use App\Models\SinhVien;
use App\Models\DeThi;

class KetQuaController extends Controller
{
    // Xem kết quả của sinh viên cho một đề thi
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

    // Views

    // Xem kết quả của sinh viên cho một đề thi
    public function view($sinhvienId, $dethiId)
    {
        $ketQua = KetQua::where('sinhvien_id', $sinhvienId)
                         ->where('dethi_id', $dethiId)
                         ->first();

        if (!$ketQua) {
            return view('ketqua.notfound');
        }

        return view('ketqua.show', compact('ketQua'));
    }
}
