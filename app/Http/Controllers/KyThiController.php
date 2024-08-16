<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KyThi;

class KyThiController extends Controller
{
    // Views

    public function index()
    {
        $kyThis = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc')->get();
        return view('kythi.index', compact('kyThis'));
    }

    public function search(Request $request)
    {
        $query = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tenKyThi', 'LIKE', "%$search%");
        }

        $kyThis = $query->get();
        return view('kythi.index', compact('kyThis'));
    }

    public function create()
    {
        return view('kythi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255',
            'ngayBatDau' => 'nullable|date',
            'ngayKetThuc' => 'nullable|date',
        ]);

        KyThi::create($request->all());
        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được thêm thành công');
    }

    public function edit($id)
    {
        $kyThi = KyThi::find($id);

        if ($kyThi) {
            return view('kythi.edit', compact('kyThi'));
        }
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255',
            'ngayBatDau' => 'nullable|date',
            'ngayKetThuc' => 'nullable|date',
        ]);

        $kyThi = KyThi::find($id);
        if ($kyThi) {
            $kyThi->update($request->all());
            return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được cập nhật thành công');
        }
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    public function destroy($id)
    {
        $kyThi = KyThi::find($id);
        if ($kyThi) {
            $kyThi->delete();
            return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được xóa thành công');
        }
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tenKyThi', 'LIKE', "%$search%");
        }

        $kyThis = $query->get();
        return response()->json($kyThis, 200);
    }

    public function apiShow($id)
    {
        $kyThi = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc')->find($id);
        if ($kyThi) {
            return response()->json($kyThi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255',
            'ngayBatDau' => 'nullable|date',
            'ngayKetThuc' => 'nullable|date',
        ]);

        $kyThi = KyThi::create($request->all());
        return response()->json($kyThi, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255',
            'ngayBatDau' => 'nullable|date',
            'ngayKetThuc' => 'nullable|date',
        ]);

        $kyThi = KyThi::find($id);
        if ($kyThi) {
            $kyThi->update($request->all());
            return response()->json($kyThi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $kyThi = KyThi::find($id);
        if ($kyThi) {
            $kyThi->delete();
            return response()->json(['message' => 'Kỳ thi đã được xóa'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}
