<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DapAn;
use App\Models\CauHoi;

class DapAnController extends Controller
{
    // Views

    public function index($cauHoiId)
    {
        $cauHoi = CauHoi::find($cauHoiId);
        if (!$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
        }

        $dapAns = DapAn::where('cauhoi_id', $cauHoiId)->get();
        return view('dapan.index', compact('cauHoi', 'dapAns'));
    }

    public function create($cauHoiId)
    {
        $cauHoi = CauHoi::find($cauHoiId);
        if (!$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
        }

        return view('dapan.create', compact('cauHoi'));
    }

    public function store(Request $request, $cauHoiId)
    {
        $request->validate([
            'typeText' => 'nullable|string|max:255',
            'typeAudio' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'dapAnDung' => 'nullable|boolean',
        ]);

        DapAn::create([
            'typeText' => $request->input('typeText'),
            'typeAudio' => $request->input('typeAudio'),
            'typeImage' => $request->input('typeImage'),
            'dapAnDung' => $request->input('dapAnDung'),
            'cauhoi_id' => $cauHoiId,
        ]);

        return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được thêm thành công');
    }

    public function edit($cauHoiId, $id)
    {
        $dapAn = DapAn::find($id);
        $cauHoi = CauHoi::find($cauHoiId);

        if (!$dapAn || !$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Không tìm thấy câu hỏi hoặc đáp án');
        }

        return view('dapan.edit', compact('dapAn', 'cauHoi'));
    }

    public function update(Request $request, $cauHoiId, $id)
    {
        $request->validate([
            'typeText' => 'nullable|string|max:255',
            'typeAudio' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'dapAnDung' => 'nullable|boolean',
        ]);

        $dapAn = DapAn::find($id);
        if ($dapAn) {
            $dapAn->update([
                'typeText' => $request->input('typeText'),
                'typeAudio' => $request->input('typeAudio'),
                'typeImage' => $request->input('typeImage'),
                'dapAnDung' => $request->input('dapAnDung'),
            ]);
            return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được cập nhật thành công');
        }
        return redirect()->route('dapan.index', $cauHoiId)->with('error', 'Đáp án không tồn tại');
    }

    public function destroy($cauHoiId, $id)
    {
        $dapAn = DapAn::find($id);
        if ($dapAn) {
            $dapAn->delete();
            return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được xóa thành công');
        }
        return redirect()->route('dapan.index', $cauHoiId)->with('error', 'Đáp án không tồn tại');
    }

    // API JSON

    public function apiIndex(Request $request, $cauHoiId)
    {
        $dapAns = DapAn::where('cauhoi_id', $cauHoiId)->get();
        return response()->json($dapAns, 200);
    }

    public function apiShow($cauHoiId, $id)
    {
        $dapAn = DapAn::where('cauhoi_id', $cauHoiId)->find($id);
        if ($dapAn) {
            return response()->json($dapAn, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request, $cauHoiId)
    {
        $request->validate([
            'typeText' => 'nullable|string|max:255',
            'typeAudio' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'dapAnDung' => 'nullable|boolean',
        ]);

        $dapAn = DapAn::create([
            'typeText' => $request->input('typeText'),
            'typeAudio' => $request->input('typeAudio'),
            'typeImage' => $request->input('typeImage'),
            'dapAnDung' => $request->input('dapAnDung'),
            'cauhoi_id' => $cauHoiId,
        ]);

        return response()->json($dapAn, 201);
    }

    public function apiUpdate(Request $request, $cauHoiId, $id)
    {
        $request->validate([
            'typeText' => 'nullable|string|max:255',
            'typeAudio' => 'nullable|string|max:255',
            'typeImage' => 'nullable|string|max:255',
            'dapAnDung' => 'nullable|boolean',
        ]);

        $dapAn = DapAn::find($id);
        if ($dapAn && $dapAn->cauhoi_id == $cauHoiId) {
            $dapAn->update([
                'typeText' => $request->input('typeText'),
                'typeAudio' => $request->input('typeAudio'),
                'typeImage' => $request->input('typeImage'),
                'dapAnDung' => $request->input('dapAnDung'),
            ]);
            return response()->json($dapAn, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($cauHoiId, $id)
    {
        $dapAn = DapAn::find($id);
        if ($dapAn && $dapAn->cauhoi_id == $cauHoiId) {
            $dapAn->delete();
            return response()->json(['message' => 'Đáp án đã được xóa'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}

