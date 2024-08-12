<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;

class KhoaController extends Controller
{
    // views

    public function index()
    {
        $khoas = Khoa::select('id', 'maKhoa', 'tenKhoa')->get();
        return view('khoa.index', compact('khoas'));
    }

    public function search(Request $request)
    {
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }

        $khoas = $query->get();
        return view('khoa.index', compact('khoas'));
    }

    public function create()
    {
        return view('khoa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        Khoa::create($request->all());
        return redirect()->route('khoa.index')->with('success', 'Khoa added successfully');
    }

    public function edit($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            return view('khoa.edit', compact('khoa'));
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->update($request->all());
            return redirect()->route('khoa.index')->with('success', 'Khoa updated successfully');
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    public function destroy($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->delete();
            return redirect()->route('khoa.index')->with('success', 'Khoa deleted successfully');
        }
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');

        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }

        $khoas = $query->get();
        return response()->json($khoas, 200);
    }

    public function apiShow($id)
    {
        $khoa = Khoa::select('id', 'maKhoa', 'tenKhoa')->find($id);
        if ($khoa) {
            return response()->json($khoa, 200);
        }
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        $khoa = Khoa::create($request->all());
        return response()->json($khoa, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->update($request->all());
            return response()->json($khoa, 200);
        }
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    public function apiDestroy($id)
    {
        $khoa = Khoa::find($id);
        if ($khoa) {
            $khoa->delete();
            return response()->json(['message' => 'Khoa deleted'], 200);
        }
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');
    
        // Thêm điều kiện tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }
    
        $khoas = $query->get();
        return response()->json($khoas, 200);
    }
}
