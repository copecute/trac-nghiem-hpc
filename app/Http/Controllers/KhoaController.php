<?php
//                       _oo0oo_
//                      o8888888o
//                      88" . "88
//                      (| -_- |)
//                      0\  =  /0
//                    ___/`---'\___
//                  .' \\|     |// '.
//                 / \\|||  :  |||// \
//                / _||||| -:- |||||- \
//               |   | \\\  -  /// |   |
//               | \_|  ''\---/''  |_/ |
//               \  .-\__  '-'  ___/-. /
//             ___'. .'  /--.--\  `. .'___
//          ."" '<  `.___\_<|>_/___.' >' "".
//         | | :  `- \`.;`\ _ /`;.`/ - ` : | |
//         \  \ `_.   \_ __\ /__ _/   .-` /  /
//     =====`-.____`.___ \_____/___.-`___.-'=====
//                       `=---='
//
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
//            amen đà phật, không bao giờ BUG
//     ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Khoa;

class KhoaController extends Controller
{
    // views

    // Hiển thị danh sách các khoa
    public function index()
    {
        // Lấy tất cả các khoa với các trường 'id', 'maKhoa', và 'tenKhoa'
        $khoas = Khoa::select('id', 'maKhoa', 'tenKhoa')->get();
        
        // Trả về view 'khoa.index' và truyền dữ liệu khoa vào view
        return view('khoa.index', compact('khoas'));
    }

    // Tìm kiếm các khoa theo từ khóa
    public function search(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maKhoa', và 'tenKhoa'
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $khoas = $query->get();
        
        // Trả về view 'khoa.index' và truyền dữ liệu khoa vào view
        return view('khoa.index', compact('khoas'));
    }

    // Hiển thị form để tạo mới khoa
    public function create()
    {
        // Trả về view 'khoa.create'
        return view('khoa.create');
    }

    // Lưu thông tin khoa mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        // Tạo mới khoa với dữ liệu từ request
        Khoa::create($request->all());

        // Chuyển hướng đến trang danh sách khoa và thông báo thành công
        return redirect()->route('khoa.index')->with('success', 'Khoa added successfully');
    }

    // Hiển thị form để chỉnh sửa thông tin khoa
    public function edit($id)
    {
        // Tìm khoa theo ID
        $khoa = Khoa::find($id);

        // Nếu tìm thấy khoa, trả về view 'khoa.edit' với dữ liệu khoa
        if ($khoa) {
            return view('khoa.edit', compact('khoa'));
        }

        // Nếu không tìm thấy khoa, chuyển hướng đến trang danh sách khoa và thông báo lỗi
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // Cập nhật thông tin khoa
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        // Tìm khoa theo ID
        $khoa = Khoa::find($id);
        
        // Nếu tìm thấy khoa, cập nhật thông tin và chuyển hướng đến trang danh sách khoa với thông báo thành công
        if ($khoa) {
            $khoa->update($request->all());
            return redirect()->route('khoa.index')->with('success', 'Khoa updated successfully');
        }

        // Nếu không tìm thấy khoa, chuyển hướng đến trang danh sách khoa và thông báo lỗi
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // Xóa khoa
    public function destroy($id)
    {
        // Tìm khoa theo ID
        $khoa = Khoa::find($id);

        // Nếu tìm thấy khoa, xóa và chuyển hướng đến trang danh sách khoa với thông báo thành công
        if ($khoa) {
            $khoa->delete();
            return redirect()->route('khoa.index')->with('success', 'Khoa deleted successfully');
        }

        // Nếu không tìm thấy khoa, chuyển hướng đến trang danh sách khoa và thông báo lỗi
        return redirect()->route('khoa.index')->with('error', 'Khoa not found');
    }

    // API JSON

    // Lấy danh sách khoa dưới dạng JSON với điều kiện tìm kiếm
    public function apiIndex(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maKhoa', và 'tenKhoa'
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $khoas = $query->get();
        
        // Trả về dữ liệu khoa dưới dạng JSON với mã trạng thái 200
        return response()->json($khoas, 200);
    }

    // Lấy thông tin khoa theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm khoa theo ID và chọn các trường 'id', 'maKhoa', và 'tenKhoa'
        $khoa = Khoa::select('id', 'maKhoa', 'tenKhoa')->find($id);
        
        // Nếu tìm thấy khoa, trả về dữ liệu khoa dưới dạng JSON với mã trạng thái 200
        if ($khoa) {
            return response()->json($khoa, 200);
        }

        // Nếu không tìm thấy khoa, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    // Tạo mới khoa và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        // Tạo mới khoa với dữ liệu từ request
        $khoa = Khoa::create($request->all());
        
        // Trả về dữ liệu khoa mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($khoa, 201);
    }

    // Cập nhật thông tin khoa và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maKhoa' => 'required|string|max:10',
            'tenKhoa' => 'required|string|max:255',
        ]);

        // Tìm khoa theo ID
        $khoa = Khoa::find($id);
        
        // Nếu tìm thấy khoa, cập nhật thông tin và trả về dữ liệu dưới dạng JSON với mã trạng thái 200
        if ($khoa) {
            $khoa->update($request->all());
            return response()->json($khoa, 200);
        }

        // Nếu không tìm thấy khoa, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    // Xóa khoa và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm khoa theo ID
        $khoa = Khoa::find($id);
        
        // Nếu tìm thấy khoa, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($khoa) {
            $khoa->delete();
            return response()->json(['message' => 'Khoa deleted'], 200);
        }

        // Nếu không tìm thấy khoa, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }

    // Tìm kiếm khoa qua API và trả về dữ liệu dưới dạng JSON
    public function apiSearch(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maKhoa', và 'tenKhoa'
        $query = Khoa::select('id', 'maKhoa', 'tenKhoa');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maKhoa', 'LIKE', "%$search%")
                  ->orWhere('tenKhoa', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $khoas = $query->get();
        
        // Trả về dữ liệu khoa dưới dạng JSON với mã trạng thái 200
        return response()->json($khoas, 200);
    }
}