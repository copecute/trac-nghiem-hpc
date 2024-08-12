<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeThi;
use App\Models\MonHoc;
use App\Models\CaThi;

class DeThiController extends Controller
{
    // Views

    public function index(Request $request)
    {
        $caThiId = $request->get('cathi_id');

        $deThis = DeThi::with('monHoc', 'caThi')
            ->where('cathi_id', $caThiId)
            ->get();

        $caThis = CaThi::all();
        $monHocs = MonHoc::all();

        return view('dethi.index', compact('deThis', 'caThiId', 'caThis', 'monHocs'));
    }

    public function create()
    {
        $caThis = CaThi::all();
        $monHocs = MonHoc::all();

        return view('dethi.create', compact('caThis', 'monHocs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenDe' => 'nullable|string|max:255',
            'soLuongCauHoi' => 'nullable|integer',
            'tiLeKho' => 'nullable|integer',
            'tiLeTrungBinh' => 'nullable|integer',
            'tiLeDe' => 'nullable|integer',
            'cauHoi' => 'nullable|json',
            'thoiGian' => 'nullable|integer',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        DeThi::create($request->all());
        return redirect()->route('dethi.index', ['cathi_id' => $request->cathi_id])->with('success', 'Đề thi đã được thêm thành công');
    }

    public function edit($id)
    {
        $deThi = DeThi::find($id);

        if ($deThi) {
            $caThis = CaThi::all();
            $monHocs = MonHoc::all();
            return view('dethi.edit', compact('deThi', 'caThis', 'monHocs'));
        }

        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tenDe' => 'nullable|string|max:255',
            'soLuongCauHoi' => 'nullable|integer',
            'tiLeKho' => 'nullable|integer',
            'tiLeTrungBinh' => 'nullable|integer',
            'tiLeDe' => 'nullable|integer',
            'cauHoi' => 'nullable|json',
            'thoiGian' => 'nullable|integer',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $deThi = DeThi::find($id);
        if ($deThi) {
            $deThi->update($request->all());
            return redirect()->route('dethi.index', ['cathi_id' => $deThi->cathi_id])->with('success', 'Đề thi đã được cập nhật thành công');
        }

        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    public function destroy($id)
    {
        $deThi = DeThi::find($id);
        if ($deThi) {
            $deThi->delete();
            return redirect()->route('dethi.index', ['cathi_id' => $deThi->cathi_id])->with('success', 'Đề thi đã được xóa thành công');
        }

        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $caThiId = $request->get('cathi_id');

        $query = DeThi::with('monHoc', 'caThi')
            ->where('cathi_id', $caThiId);

        $deThis = $query->get();
        return response()->json($deThis, 200);
    }

    public function apiShow($id)
    {
        $deThi = DeThi::with('monHoc', 'caThi')->find($id);
        if ($deThi) {
            return response()->json($deThi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'tenDe' => 'nullable|string|max:255',
            'soLuongCauHoi' => 'nullable|integer',
            'tiLeKho' => 'nullable|integer',
            'tiLeTrungBinh' => 'nullable|integer',
            'tiLeDe' => 'nullable|integer',
            'cauHoi' => 'nullable|json',
            'thoiGian' => 'nullable|integer',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $deThi = DeThi::create($request->all());
        return response()->json($deThi, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'tenDe' => 'nullable|string|max:255',
            'soLuongCauHoi' => 'nullable|integer',
            'tiLeKho' => 'nullable|integer',
            'tiLeTrungBinh' => 'nullable|integer',
            'tiLeDe' => 'nullable|integer',
            'cauHoi' => 'nullable|json',
            'thoiGian' => 'nullable|integer',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
            'cathi_id' => 'required|exists:tb_CaThi,id',
        ]);

        $deThi = DeThi::find($id);
        if ($deThi) {
            $deThi->update($request->all());
            return response()->json($deThi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $deThi = DeThi::find($id);
        if ($deThi) {
            $deThi->delete();
            return response()->json(['message' => 'Đề thi đã được xóa'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}

