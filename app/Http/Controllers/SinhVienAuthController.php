<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SinhVien;
use Illuminate\Support\Facades\Hash;

class SinhVienAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|exists:tb_SinhVien,maSV',
            'matKhau' => 'required',
        ]);
    
        $sinhVien = SinhVien::where('maSV', $request->maSV)->first();
    
        if (!$sinhVien || !Hash::check($request->matKhau, $sinhVien->matKhau)) {
            return response()->json(['message' => 'Thông tin đăng nhập không hợp lệ'], 401);
        }
    
        // Tạo token và trả về
        $token = $sinhVien->createToken('copecuteHPC')->plainTextToken;
    
        return response()->json([
            'message' => 'Đăng nhập thành công',
            'token' => $token,
        ]);
    }
}
