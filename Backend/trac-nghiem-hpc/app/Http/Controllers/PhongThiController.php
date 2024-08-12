<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhongThi;
use App\Models\CaThi;

class PhongThiController extends Controller
{
    // Views

    public function index(Request $request)
    {
        $cathiId = $request->input('cathi_id');
        $query = PhongThi::query();

        if ($cathiId) {
            $query->where('cathi_id', $cathiId);
        }

        $phongThis = $query->get();
        $caThis = CaThi::all(); // Lấy danh sách Ca Thi để chọn
        return view('phongthi.index', compact('phongThis', 'caThis', 'cathiId'));
    }

    public function create()
    {
        $caThis = CaThi::all(); // Lấy danh sách Ca Thi để chọn
        return view('phongthi.create', compact('caThis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255',
            'danhSachSinhVien' => 'nullable|json',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $phongThi = PhongThi::create($request->all());
        return redirect()->route('phongthi.index')->with('success', 'Phòng Thi added successfully');
    }

    public function edit($id)
    {
        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            $caThis = CaThi::all(); // Lấy danh sách Ca Thi để chọn
            return view('phongthi.edit', compact('phongThi', 'caThis'));
        }
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255',
            'danhSachSinhVien' => 'nullable|json',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            $phongThi->update($request->all());
            return redirect()->route('phongthi.index')->with('success', 'Phòng Thi updated successfully');
        }
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    public function destroy($id)
    {
        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            $phongThi->delete();
            return redirect()->route('phongthi.index')->with('success', 'Phòng Thi deleted successfully');
        }
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = PhongThi::query();

        if ($request->has('cathi_id')) {
            $query->where('cathi_id', $request->input('cathi_id'));
        }

        $phongThis = $query->get();
        return response()->json($phongThis, 200);
    }

    public function apiShow($id)
    {
        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            return response()->json($phongThi, 200);
        }
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255',
            'danhSachSinhVien' => 'nullable|json',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $phongThi = PhongThi::create($request->all());
        return response()->json($phongThi, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255',
            'danhSachSinhVien' => 'nullable|json',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            $phongThi->update($request->all());
            return response()->json($phongThi, 200);
        }
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    public function apiDestroy($id)
    {
        $phongThi = PhongThi::find($id);
        if ($phongThi) {
            $phongThi->delete();
            return response()->json(['message' => 'Phòng Thi deleted'], 200);
        }
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }
}
