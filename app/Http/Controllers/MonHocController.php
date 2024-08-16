<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\Nghanh;

class MonHocController extends Controller
{
    // Views

    public function index()
    {
        $monHocs = MonHoc::with('nghanh:id,tenNghanh')->select('id', 'maMonHoc', 'tenMonHoc', 'nghanh_id')->get();
        return view('monhoc.index', compact('monHocs'));
    }

    public function search(Request $request)
    {
        $query = MonHoc::with('nghanh:id,tenNghanh')->select('id', 'maMonHoc', 'tenMonHoc', 'nghanh_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maMonHoc', 'LIKE', "%$search%")
                  ->orWhere('tenMonHoc', 'LIKE', "%$search%");
        }

        $monHocs = $query->get();
        return view('monhoc.index', compact('monHocs'));
    }

    public function create()
    {
        $nghanhs = Nghanh::select('id', 'tenNghanh')->get();
        return view('monhoc.create', compact('nghanhs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'maMonHoc' => 'required|string|max:10',
            'tenMonHoc' => 'required|string|max:255',
            'nghanh_id' => 'required|exists:tb_Nghanh,id',
        ]);

        MonHoc::create($request->all());
        return redirect()->route('monhoc.index')->with('success', 'Môn học đã được thêm thành công');
    }

    public function edit($id)
    {
        $monHoc = MonHoc::find($id);
        $nghanhs = Nghanh::select('id', 'tenNghanh')->get();

        if ($monHoc) {
            return view('monhoc.edit', compact('monHoc', 'nghanhs'));
        }
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maMonHoc' => 'required|string|max:10',
            'tenMonHoc' => 'required|string|max:255',
            'nghanh_id' => 'required|exists:tb_Nghanh,id',
        ]);

        $monHoc = MonHoc::find($id);
        if ($monHoc) {
            $monHoc->update($request->all());
            return redirect()->route('monhoc.index')->with('success', 'Môn học đã được cập nhật thành công');
        }
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    public function destroy($id)
    {
        $monHoc = MonHoc::find($id);
        if ($monHoc) {
            $monHoc->delete();
            return redirect()->route('monhoc.index')->with('success', 'Môn học đã được xóa thành công');
        }
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = MonHoc::select('id', 'maMonHoc', 'tenMonHoc', 'nghanh_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maMonHoc', 'LIKE', "%$search%")
                  ->orWhere('tenMonHoc', 'LIKE', "%$search%");
        }

        $monHocs = $query->get();
        return response()->json($monHocs, 200);
    }

    public function apiShow($id)
    {
        $monHoc = MonHoc::select('id', 'maMonHoc', 'tenMonHoc', 'nghanh_id')->find($id);
        if ($monHoc) {
            return response()->json($monHoc, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maMonHoc' => 'required|string|max:10',
            'tenMonHoc' => 'required|string|max:255',
            'nghanh_id' => 'required|exists:tb_Nghanh,id',
        ]);

        $monHoc = MonHoc::create($request->all());
        return response()->json($monHoc, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maMonHoc' => 'required|string|max:10',
            'tenMonHoc' => 'required|string|max:255',
            'nghanh_id' => 'required|exists:tb_Nghanh,id',
        ]);

        $monHoc = MonHoc::find($id);
        if ($monHoc) {
            $monHoc->update($request->all());
            return response()->json($monHoc, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $monHoc = MonHoc::find($id);
        if ($monHoc) {
            $monHoc->delete();
            return response()->json(['message' => 'Môn học đã được xóa'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }
}

