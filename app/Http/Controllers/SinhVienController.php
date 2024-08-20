<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Lop;
use Illuminate\Support\Facades\Hash;

class SinhVienController extends Controller
{
    // Views

    public function index()
    {
        $sinhViens = SinhVien::with('lop')->get();
        return view('sinhvien.index', compact('sinhViens'));
    }

    public function search(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        $sinhViens = $query->get();
        return view('sinhvien.index', compact('sinhViens'));
    }

    public function create()
    {
        $lops = Lop::select('id', 'tenLop')->get();
        return view('sinhvien.create', compact('lops'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien',
            'matKhau' => 'required|string|min:8', // Đảm bảo mật khẩu có độ dài tối thiểu
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien',
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);
    
        SinhVien::create([
            'maSV' => $request->maSV,
            'matKhau' => Hash::make($request->matKhau), // Mã hóa mật khẩu
            'hoTen' => $request->hoTen,
            'ngaySinh' => $request->ngaySinh,
            'gioiTinh' => $request->gioiTinh,
            'diaChi' => $request->diaChi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'lop_id' => $request->lop_id,
        ]);
    
        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được thêm thành công');
    }

    public function edit($id)
    {
        $sinhVien = SinhVien::find($id);
        $lops = Lop::select('id', 'tenLop')->get();

        if ($sinhVien) {
            return view('sinhvien.edit', compact('sinhVien', 'lops'));
        }

        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien,maSV,' . $id,
            'matKhau' => 'nullable|string|min:6', // Mật khẩu có thể là null
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien,email,' . $id,
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);
    
        $sinhVien = SinhVien::find($id);
    
        if ($sinhVien) {
            $sinhVien->update([
                'maSV' => $request->maSV,
                'hoTen' => $request->hoTen,
                'ngaySinh' => $request->ngaySinh,
                'gioiTinh' => $request->gioiTinh,
                'diaChi' => $request->diaChi,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'lop_id' => $request->lop_id,
            ]);
    
            // Cập nhật mật khẩu chỉ nếu có thay đổi
            if ($request->filled('matKhau')) {
                $sinhVien->update(['matKhau' => Hash::make($request->matKhau)]);
            }
    
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được cập nhật thành công');
        }
    
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    public function destroy($id)
    {
        $sinhVien = SinhVien::find($id);

        if ($sinhVien) {
            $sinhVien->delete();
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được xóa thành công');
        }

        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        $sinhViens = $query->get();
        return response()->json($sinhViens, 200);
    }

    public function apiShow($id)
    {
        $sinhVien = SinhVien::with('lop')->find($id);
        if ($sinhVien) {
            return response()->json($sinhVien, 200);
        }

        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien',
            'matKhau' => 'required|string|max:255',
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien',
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);

        $sinhVien = SinhVien::create([
            'maSV' => $request->maSV,
            'hoTen' => $request->hoTen,
            'ngaySinh' => $request->ngaySinh,
            'gioiTinh' => $request->gioiTinh,
            'diaChi' => $request->diaChi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'lop_id' => $request->lop_id,
            'matKhau' => Hash::make($request->matKhau),
        ]);

        return response()->json($sinhVien, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien,maSV,' . $id,
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien,email,' . $id,
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);

        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            $sinhVien->update([
                'maSV' => $request->maSV,
                'hoTen' => $request->hoTen,
                'ngaySinh' => $request->ngaySinh,
                'gioiTinh' => $request->gioiTinh,
                'diaChi' => $request->diaChi,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'lop_id' => $request->lop_id,
            ]);

            return response()->json($sinhVien, 200);
        }

        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    public function apiDestroy($id)
    {
        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            $sinhVien->delete();
            return response()->json(['message' => 'Sinh viên đã được xóa'], 200);
        }

        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        $sinhViens = $query->get();
        return response()->json($sinhViens, 200);
    }
}
