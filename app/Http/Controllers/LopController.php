<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lop;
use App\Models\Nganh;

class LopController extends Controller
{
    // views

    public function index()
    {
        $lops = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id')->get();
        return view('lop.index', compact('lops'));
    }

    public function search(Request $request)
    {
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        $lops = $query->get();
        return view('lop.index', compact('lops'));
    }

    public function create()
    {
        $nganhs = Nganh::select('id', 'tenNganh')->get();
        return view('lop.create', compact('nganhs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'maLop' => 'required|string|max:10',
            'tenLop' => 'required|string|max:255',
            'nganh_id' => 'required|exists:tb_Nganh,id',
        ]);

        Lop::create($request->all());
        return redirect()->route('lop.index')->with('success', 'Lop added successfully');
    }

    public function edit($id)
    {
        $lop = Lop::find($id);
        $nganhs = Nganh::select('id', 'tenNganh')->get();

        if ($lop) {
            return view('lop.edit', compact('lop', 'nganhs'));
        }
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'maLop' => 'required|string|max:10',
            'tenLop' => 'required|string|max:255',
            'nganh_id' => 'required|exists:tb_Nganh,id',
        ]);

        $lop = Lop::find($id);
        if ($lop) {
            $lop->update($request->all());
            return redirect()->route('lop.index')->with('success', 'Lop updated successfully');
        }
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    public function destroy($id)
    {
        $lop = Lop::find($id);
        if ($lop) {
            $lop->delete();
            return redirect()->route('lop.index')->with('success', 'Lop deleted successfully');
        }
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    // API JSON

    public function apiIndex(Request $request)
    {
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        $lops = $query->get();
        return response()->json($lops, 200);
    }

    public function apiShow($id)
    {
        $lop = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id')->find($id);
        if ($lop) {
            return response()->json($lop, 200);
        }
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'maLop' => 'required|string|max:10',
            'tenLop' => 'required|string|max:255',
            'nganh_id' => 'required|exists:tb_Nganh,id',
        ]);

        $lop = Lop::create($request->all());
        return response()->json($lop, 201);
    }

    public function apiUpdate(Request $request, $id)
    {
        $request->validate([
            'maLop' => 'required|string|max:10',
            'tenLop' => 'required|string|max:255',
            'nganh_id' => 'required|exists:tb_Nganh,id',
        ]);

        $lop = Lop::find($id);
        if ($lop) {
            $lop->update($request->all());
            return response()->json($lop, 200);
        }
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    public function apiDestroy($id)
    {
        $lop = Lop::find($id);
        if ($lop) {
            $lop->delete();
            return response()->json(['message' => 'Lop deleted'], 200);
        }
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }

    public function apiSearch(Request $request)
    {
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        $lops = $query->get();
        return response()->json($lops, 200);
    }
}
