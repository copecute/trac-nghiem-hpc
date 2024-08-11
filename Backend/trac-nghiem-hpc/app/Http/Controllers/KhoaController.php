<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;

class KhoaController extends Controller
{
    // Xem danh sách các Khoa
    public function index()
    {
        return response()->json(Khoa::all(), 200);
    }

    // Xem chi tiết 1 Khoa
    public function show($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            return response()->json($khoa, 200);
        }
        return response()->json(['message' => 'Khoa not found'], 404);
    }

    // Thêm mới 1 Khoa
    public function store(Request $request)
    {
        $khoa = Khoa::create($request->all());
        return response()->json($khoa, 201);
    }

    // Cập nhật thông tin 1 Khoa
    public function update(Request $request, $id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->update($request->all());
            return response()->json($khoa, 200);
        }
        return response()->json(['message' => 'Khoa not found'], 404);
    }

    // Xóa 1 Khoa
    public function destroy($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->delete();
            return response()->json(['message' => 'Khoa deleted'], 200);
        }
        return response()->json(['message' => 'Khoa not found'], 404);
    }
}
