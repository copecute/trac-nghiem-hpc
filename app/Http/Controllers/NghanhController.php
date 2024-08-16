<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nghanh;
use App\Models\Khoa;

class NghanhController extends Controller
{
    // Web Methods

    public function index()
    {
        $nghanhs = Nghanh::with('khoa')->select('id', 'maNghanh', 'tenNghanh', 'khoa_id')->get();
        return view('nghanh.index', compact('nghanhs'));
    }

    public function search(Request $request)
    {
        $query = Nghanh::with('khoa')->select('id', 'maNghanh', 'tenNghanh', 'khoa_id');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNghanh', 'LIKE', "%$search%")
                  ->orWhere('tenNghanh', 'LIKE', "%$search%");
        }

        $nghanhs = $query->get();
        return view('nghanh.index', compact('nghanhs'));
    }

    public function create()
    {
        $khoas = Khoa::select('id', 'tenKhoa')->get(); // Lấy danh sách các Khoa
        return view('nghanh.create', compact('khoas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'maNghanh' => 'required|string|max:10',
            'tenNghanh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        Nghanh::create($request->all());
        return redirect()->route('nghanh.index')->with('success', 'Ngành added successfully');
    }

    public function edit($id)
    {
        $nghanh = Nghanh::find($id);
        if ($nghanh) {
            $khoas = Khoa::select('id', 'tenKhoa')->get(); // Lấy danh sách các Khoa
            return view('nghanh.edit', compact('nghanh', 'khoas'));
        }
        return redirect()->route('nghanh.index')->with('error', 'Ngành not found');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maNghanh' => 'required|string|max:10',
            'tenNghanh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nghanh = Nghanh::find($id);
        if ($nghanh) {
            $nghanh->update($request->all());
            return redirect()->route('nghanh.index')->with('success', 'Ngành updated successfully');
        }
        return redirect()->route('nghanh.index')->with('error', 'Ngành not found');
    }

    public function destroy($id)
    {
        $nghanh = Nghanh::find($id);
        if ($nghanh) {
            $nghanh->delete();
            return redirect()->route('nghanh.index')->with('success', 'Ngành deleted successfully');
        }
        return redirect()->route('nghanh.index')->with('error', 'Ngành not found');
    }

    // API JSON Methods

    public function apiIndex(Request $request)
    {
        $query = Nghanh::with('khoa')->select('id', 'maNghanh', 'tenNghanh', 'khoa_id');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNghanh', 'LIKE', "%$search%")
                  ->orWhere('tenNghanh', 'LIKE', "%$search%");
        }

        $nghanhs = $query->get();
        return response()->json($nghanhs, 200);
    }

    public function apiShow($id)
    {
        $nghanh = Nghanh::with('khoa')->select('id', 'maNghanh', 'tenNghanh', 'khoa_id')->find($id);
        if ($nghanh) {
            return response()->json($nghanh, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maNghanh' => 'required|string|max:10',
            'tenNghanh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nghanh = Nghanh::create($request->all());
        return response()->json($nghanh, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maNghanh' => 'required|string|max:10',
            'tenNghanh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nghanh = Nghanh::find($id);
        if ($nghanh) {
            $nghanh->update($request->all());
            return response()->json($nghanh, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $nghanh = Nghanh::find($id);
        if ($nghanh) {
            $nghanh->delete();
            return response()->json(['message' => 'Ngành deleted'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = Nghanh::with('khoa')->select('id', 'maNghanh', 'tenNghanh', 'khoa_id');
    
        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNghanh', 'LIKE', "%$search%")
                  ->orWhere('tenNghanh', 'LIKE', "%$search%");
        }
    
        $nghanhs = $query->get();
        return response()->json($nghanhs, 200);
    }
}