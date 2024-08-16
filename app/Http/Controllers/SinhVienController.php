<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\Lop;

class SinhVienController extends Controller
{
    // views

    public function index()
    {
        $sinhViens = SinhVien::with('lop')->get();
        return view('sinhvien.index', compact('sinhViens'));
    }

    public function search(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->has('search')) {
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
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien',
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);

        SinhVien::create($request->all());
        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên added successfully');
    }

    public function edit($id)
    {
        $sinhVien = SinhVien::find($id);
        $lops = Lop::select('id', 'tenLop')->get();

        if ($sinhVien) {
            return view('sinhvien.edit', compact('sinhVien', 'lops'));
        }
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên not found');
    }

    public function update(Request $request, $id)
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
            $sinhVien->update($request->all());
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên updated successfully');
        }
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên not found');
    }

    public function destroy($id)
    {
        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            $sinhVien->delete();
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên deleted successfully');
        }
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên not found');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->has('search')) {
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
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien',
            'hoTen' => 'required|string|max:255',
            'ngaySinh' => 'required|date',
            'gioiTinh' => 'required|string|max:10',
            'diaChi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:tb_SinhVien',
            'lop_id' => 'required|exists:tb_Lop,id',
        ]);

        $sinhVien = SinhVien::create($request->all());
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
            $sinhVien->update($request->all());
            return response()->json($sinhVien, 200);
        }
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    public function apiDestroy($id)
    {
        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            $sinhVien->delete();
            return response()->json(['message' => 'Sinh viên deleted'], 200);
        }
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = SinhVien::with('lop');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        $sinhViens = $query->get();
        return response()->json($sinhViens, 200);
    }
}
