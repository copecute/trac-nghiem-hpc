<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nganh;
use App\Models\Khoa;

class NganhController extends Controller
{
    // Web Methods

    public function index()
    {
        $nganhs = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id')->get();
        return view('nganh.index', compact('nganhs'));
    }

    public function search(Request $request)
    {
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }

        $nganhs = $query->get();
        return view('nganh.index', compact('nganhs'));
    }

    public function create()
    {
        $khoas = Khoa::select('id', 'tenKhoa')->get(); // Lấy danh sách các Khoa
        return view('nganh.create', compact('khoas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'maNganh' => 'required|string|max:10',
            'tenNganh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        Nganh::create($request->all());
        return redirect()->route('nganh.index')->with('success', 'Ngành added successfully');
    }

    public function edit($id)
    {
        $nganh = Nganh::find($id);
        if ($nganh) {
            $khoas = Khoa::select('id', 'tenKhoa')->get(); // Lấy danh sách các Khoa
            return view('nganh.edit', compact('nganh', 'khoas'));
        }
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maNganh' => 'required|string|max:10',
            'tenNganh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nganh = Nganh::find($id);
        if ($nganh) {
            $nganh->update($request->all());
            return redirect()->route('nganh.index')->with('success', 'Ngành updated successfully');
        }
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    public function destroy($id)
    {
        $nganh = Nganh::find($id);
        if ($nganh) {
            $nganh->delete();
            return redirect()->route('nganh.index')->with('success', 'Ngành deleted successfully');
        }
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    // API JSON Methods

    public function apiIndex(Request $request)
    {
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }

        $nganhs = $query->get();
        return response()->json($nganhs, 200);
    }

    public function apiShow($id)
    {
        $nganh = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id')->find($id);
        if ($nganh) {
            return response()->json($nganh, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maNganh' => 'required|string|max:10',
            'tenNganh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nganh = Nganh::create($request->all());
        return response()->json($nganh, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maNganh' => 'required|string|max:10',
            'tenNganh' => 'required|string|max:255',
            'khoa_id' => 'required|exists:tb_Khoa,id', // Kiểm tra khóa ngoại
        ]);

        $nganh = Nganh::find($id);
        if ($nganh) {
            $nganh->update($request->all());
            return response()->json($nganh, 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiDestroy($id)
    {
        $nganh = Nganh::find($id);
        if ($nganh) {
            $nganh->delete();
            return response()->json(['message' => 'Ngành deleted'], 200);
        }
        return response()->json(['message' => 'Not found'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');
    
        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }
    
        $nganhs = $query->get();
        return response()->json($nganhs, 200);
    }
}