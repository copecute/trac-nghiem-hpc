<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CauHoi;
use App\Models\MonHoc;

class CauHoiController extends Controller
{
    // Views

    public function index()
    {
        $cauHois = CauHoi::with('monhoc:id,tenMonHoc')->select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id')->get();
        return view('cauhoi.index', compact('cauHois'));
    }

    public function search(Request $request)
    {
        $query = CauHoi::with('monhoc:id,tenMonHoc')->select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('noiDung', 'LIKE', "%$search%")
                  ->orWhereHas('monhoc', function ($query) use ($search) {
                      $query->where('tenMonHoc', 'LIKE', "%$search%");
                  });
        }

        $cauHois = $query->get();
        return view('cauhoi.index', compact('cauHois'));
    }

    public function create()
    {
        $monhocs = MonHoc::select('id', 'tenMonHoc')->get();
        return view('cauhoi.create', compact('monhocs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'noiDung' => 'nullable|string',
            'typeAudio' => 'nullable|string|max:255',
            'typeVideo' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'doKho' => 'nullable|integer|min:1|max:5',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        CauHoi::create($request->all());
        return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được thêm thành công');
    }

    public function edit($id)
    {
        $cauHoi = CauHoi::find($id);
        $monhocs = MonHoc::select('id', 'tenMonHoc')->get();

        if ($cauHoi) {
            return view('cauhoi.edit', compact('cauHoi', 'monhocs'));
        }
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'noiDung' => 'nullable|string',
            'typeAudio' => 'nullable|string|max:255',
            'typeVideo' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'doKho' => 'nullable|integer|min:1|max:5',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cauHoi = CauHoi::find($id);
        if ($cauHoi) {
            $cauHoi->update($request->all());
            return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được cập nhật thành công');
        }
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    public function destroy($id)
    {
        $cauHoi = CauHoi::find($id);
        if ($cauHoi) {
            $cauHoi->delete();
            return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được xóa thành công');
        }
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = CauHoi::select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('noiDung', 'LIKE', "%$search%")
                  ->orWhereHas('monhoc', function ($query) use ($search) {
                      $query->where('tenMonHoc', 'LIKE', "%$search%");
                  });
        }

        $cauHois = $query->get();
        return response()->json($cauHois, 200);
    }

    public function apiShow($id)
    {
        $cauHoi = CauHoi::select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id')->find($id);
        if ($cauHoi) {
            return response()->json($cauHoi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'noiDung' => 'nullable|string',
            'typeAudio' => 'nullable|string|max:255',
            'typeVideo' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'doKho' => 'nullable|integer|min:1|max:5',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cauHoi = CauHoi::create($request->all());
        return response()->json($cauHoi, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'noiDung' => 'nullable|string',
            'typeAudio' => 'nullable|string|max:255',
            'typeVideo' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'doKho' => 'nullable|integer|min:1|max:5',
            'monhoc_id' => 'required|exists:tb_MonHoc,id',
        ]);

        $cauHoi = CauHoi::find($id);
        if ($cauHoi) {
            $cauHoi->update($request->all());
            return response()->json($cauHoi, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $cauHoi = CauHoi::find($id);
        if ($cauHoi) {
            $cauHoi->delete();
            return response()->json(['message' => 'Câu hỏi đã được xóa'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}
