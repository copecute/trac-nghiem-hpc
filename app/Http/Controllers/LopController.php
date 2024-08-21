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
use App\Models\Lop;
use App\Models\Nganh;

class LopController extends Controller
{
    // views

    // Hiển thị danh sách tất cả các lớp học
    public function index()
    {
        // Lấy tất cả các lớp học cùng với thông tin ngành (ngành là quan hệ đã được định nghĩa trong mô hình Lop)
        $lops = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id')->get();
        
        // Trả về view 'lop.index' và truyền dữ liệu lớp học vào view
        return view('lop.index', compact('lops'));
    }

    // Tìm kiếm lớp học theo từ khóa
    public function search(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maLop', 'tenLop', và 'nganh_id' cùng với thông tin ngành
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã lớp hoặc tên lớp
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $lops = $query->get();
        
        // Trả về view 'lop.index' và truyền dữ liệu lớp học vào view
        return view('lop.index', compact('lops'));
    }

    // Hiển thị form để tạo mới lớp học
    public function create()
    {
        // Lấy tất cả các ngành để hiển thị trong dropdown
        $nganhs = Nganh::select('id', 'tenNganh')->get();
        
        // Trả về view 'lop.create' với dữ liệu các ngành
        return view('lop.create', compact('nganhs'));
    }

    // Lưu thông tin lớp học mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maLop' => 'required|string|max:10', // 'maLop' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenLop' => 'required|string|max:255', // 'tenLop' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tạo mới lớp học với dữ liệu từ request
        Lop::create($request->all());
        
        // Chuyển hướng đến trang danh sách lớp học và thông báo thành công
        return redirect()->route('lop.index')->with('success', 'Lop added successfully');
    }

    // Hiển thị form để chỉnh sửa thông tin lớp học
    public function edit($id)
    {
        // Tìm lớp học theo ID
        $lop = Lop::find($id);
        
        // Lấy tất cả các ngành để hiển thị trong dropdown
        $nganhs = Nganh::select('id', 'tenNganh')->get();

        // Nếu tìm thấy lớp học, trả về view 'lop.edit' với dữ liệu lớp học và ngành
        if ($lop) {
            return view('lop.edit', compact('lop', 'nganhs'));
        }
        
        // Nếu không tìm thấy lớp học, chuyển hướng đến trang danh sách lớp học và thông báo lỗi
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    // Cập nhật thông tin lớp học
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maLop' => 'required|string|max:10', // 'maLop' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenLop' => 'required|string|max:255', // 'tenLop' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tìm lớp học theo ID
        $lop = Lop::find($id);
        
        // Nếu tìm thấy lớp học, cập nhật thông tin và chuyển hướng đến trang danh sách lớp học với thông báo thành công
        if ($lop) {
            $lop->update($request->all());
            return redirect()->route('lop.index')->with('success', 'Lop updated successfully');
        }
        
        // Nếu không tìm thấy lớp học, chuyển hướng đến trang danh sách lớp học và thông báo lỗi
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    // Xóa lớp học
    public function destroy($id)
    {
        // Tìm lớp học theo ID
        $lop = Lop::find($id);
        
        // Nếu tìm thấy lớp học, xóa và chuyển hướng đến trang danh sách lớp học với thông báo thành công
        if ($lop) {
            $lop->delete();
            return redirect()->route('lop.index')->with('success', 'Lop deleted successfully');
        }
        
        // Nếu không tìm thấy lớp học, chuyển hướng đến trang danh sách lớp học và thông báo lỗi
        return redirect()->route('lop.index')->with('error', 'Lop not found');
    }

    // API JSON

    // Lấy danh sách lớp học dưới dạng JSON với khả năng tìm kiếm
    public function apiIndex(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maLop', 'tenLop', và 'nganh_id' cùng với thông tin ngành
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã lớp hoặc tên lớp
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $lops = $query->get();
        
        // Trả về dữ liệu lớp học dưới dạng JSON với mã trạng thái 200
        return response()->json($lops, 200);
    }

    // Lấy thông tin lớp học theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm lớp học theo ID cùng với thông tin ngành
        $lop = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id')->find($id);
        
        // Nếu tìm thấy lớp học, trả về dữ liệu lớp học dưới dạng JSON với mã trạng thái 200
        if ($lop) {
            return response()->json($lop, 200);
        }
        
        // Nếu không tìm thấy lớp học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    // Tạo mới lớp học và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maLop' => 'required|string|max:10', // 'maLop' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenLop' => 'required|string|max:255', // 'tenLop' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tạo mới lớp học với dữ liệu từ request
        $lop = Lop::create($request->all());
        
        // Trả về dữ liệu lớp học mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($lop, 201);
    }

    // Cập nhật thông tin lớp học và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maLop' => 'required|string|max:10', // 'maLop' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenLop' => 'required|string|max:255', // 'tenLop' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tìm lớp học theo ID
        $lop = Lop::find($id);
        
        // Nếu tìm thấy lớp học, cập nhật thông tin và trả về dữ liệu lớp học dưới dạng JSON với mã trạng thái 200
        if ($lop) {
            $lop->update($request->all());
            return response()->json($lop, 200);
        }
        
        // Nếu không tìm thấy lớp học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    // Xóa lớp học và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm lớp học theo ID
        $lop = Lop::find($id);
        
        // Nếu tìm thấy lớp học, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($lop) {
            $lop->delete();
            return response()->json(['message' => 'Lop deleted'], 200);
        }
        
        // Nếu không tìm thấy lớp học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }

    // Tìm kiếm lớp học qua API và trả về kết quả dưới dạng JSON
    public function apiSearch(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maLop', 'tenLop', và 'nganh_id' cùng với thông tin ngành
        $query = Lop::with('nganh')->select('id', 'maLop', 'tenLop', 'nganh_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã lớp hoặc tên lớp
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maLop', 'LIKE', "%$search%")
                ->orWhere('tenLop', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $lops = $query->get();
        
        // Trả về dữ liệu lớp học dưới dạng JSON với mã trạng thái 200
        return response()->json($lops, 200);
    }
}