<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;

class KhoaController extends Controller
{
    // Xem danh sách các Khoa
    public function index()
    {
        $khoas = Khoa::select('id', 'maKhoa', 'tenKhoa')->get();
        return view('khoa.index', compact('khoas'));
    }

    // Xem chi tiết 1 Khoa
    public function show($id)
    {
        $khoa = Khoa::select('id', 'maKhoa', 'tenKhoa')->find($id);
        if ($khoa) {
            return response()->json($khoa, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    // Hiển thị form thêm mới
    public function create()
    {
        return view('khoa.create');
    }

    // Thêm mới 1 Khoa
    public function store(Request $request)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        $khoa = Khoa::create($request->all());
        return redirect()->route('khoa.index')->with('success', 'Khoa added successfully');
    }

    // Hiển thị form chỉnh sửa
    public function edit($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            return view('khoa.edit', compact('khoa'));
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // Cập nhật thông tin 1 Khoa
    public function update(Request $request, $id)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->update($request->all());
            return redirect()->route('khoa.index')->with('success', 'Khoa updated successfully');
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // Xóa 1 Khoa
    public function destroy($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->delete();
            return redirect()->route('khoa.index')->with('success', 'Khoa deleted successfully');
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }
}
