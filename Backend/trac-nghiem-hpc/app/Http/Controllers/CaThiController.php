<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaThi;
use App\Models\MonHoc;

class CaThiController extends Controller
{
    // Views
    public function index($kythi_id) {
        $cathis = CaThi::where('kythi_id', $kythi_id)->get();
        $monhocs = MonHoc::all(); 
        return view('cathi.index', compact('cathis', 'kythi_id', 'monhocs'));
    }

    public function create($kythi_id) {
        $monhocs = MonHoc::all();
        return view('cathi.create', compact('kythi_id', 'monhocs'));
    }

    public function store(Request $request, $kythi_id) {
        $request->validate([
            'tenCa' => 'nullable|string|max:255',
            'thoiGianBatDau' => 'nullable|date',
            'thoiGianKetThuc' => 'nullable|date',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        CaThi::create(array_merge($request->all(), ['kythi_id' => $kythi_id]));
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi added successfully');
    }

    public function edit($kythi_id, $id) {
        $cathi = CaThi::find($id);
        if ($cathi) {
            $monhocs = MonHoc::all();
            return view('cathi.edit', compact('cathi', 'kythi_id', 'monhocs'));
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi not found');
    }

    public function update(Request $request, $kythi_id, $id) {
        $request->validate([
            'tenCa' => 'nullable|string|max:255',
            'thoiGianBatDau' => 'nullable|date',
            'thoiGianKetThuc' => 'nullable|date',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cathi = CaThi::find($id);
        if ($cathi) {
            $cathi->update($request->all());
            return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi updated successfully');
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi not found');
    }

    public function destroy($kythi_id, $id) {
        $cathi = CaThi::find($id);
        if ($cathi) {
            $cathi->delete();
            return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi deleted successfully');
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi not found');
    }

    // API JSON
    public function apiIndex($kythi_id) {
        return response()->json(CaThi::where('kythi_id', $kythi_id)->get(), 200);
    }

    public function apiStore(Request $request, $kythi_id) {
        $request->validate([
            'tenCa' => 'nullable|string|max:255',
            'thoiGianBatDau' => 'nullable|date',
            'thoiGianKetThuc' => 'nullable|date',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cathi = CaThi::create(array_merge($request->all(), ['kythi_id' => $kythi_id]));
        return response()->json($cathi, 201);
    }

    public function apiShow($kythi_id, $id) {
        $cathi = CaThi::find($id);
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            return response()->json($cathi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiUpdate(Request $request, $kythi_id, $id) {
        $request->validate([
            'tenCa' => 'nullable|string|max:255',
            'thoiGianBatDau' => 'nullable|date',
            'thoiGianKetThuc' => 'nullable|date',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cathi = CaThi::find($id);
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            $cathi->update($request->all());
            return response()->json($cathi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($kythi_id, $id) {
        $cathi = CaThi::find($id);
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            $cathi->delete();
            return response()->json(['message' => 'Ca thi deleted'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}
