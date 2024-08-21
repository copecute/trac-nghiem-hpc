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
use App\Models\MonHoc;
use App\Models\Nganh;

class MonHocController extends Controller
{
    // Views

    // Hiển thị danh sách tất cả các môn học
    public function index()
    {
        // Lấy tất cả các môn học cùng với thông tin ngành (ngành là quan hệ đã được định nghĩa trong mô hình MonHoc)
        $monHocs = MonHoc::with('nganh:id,tenNganh')->select('id', 'maMonHoc', 'tenMonHoc', 'nganh_id')->get();
        
        // Trả về view 'monhoc.index' và truyền dữ liệu môn học vào view
        return view('monhoc.index', compact('monHocs'));
    }

    // Tìm kiếm môn học theo từ khóa
    public function search(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maMonHoc', 'tenMonHoc', và 'nganh_id' cùng với thông tin ngành
        $query = MonHoc::with('nganh:id,tenNganh')->select('id', 'maMonHoc', 'tenMonHoc', 'nganh_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã môn học hoặc tên môn học
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maMonHoc', 'LIKE', "%$search%")
                  ->orWhere('tenMonHoc', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $monHocs = $query->get();
        
        // Trả về view 'monhoc.index' và truyền dữ liệu môn học vào view
        return view('monhoc.index', compact('monHocs'));
    }

    // Hiển thị form để tạo mới môn học
    public function create()
    {
        // Lấy tất cả các ngành để hiển thị trong dropdown
        $nganhs = Nganh::select('id', 'tenNganh')->get();
        
        // Trả về view 'monhoc.create' với dữ liệu các ngành
        return view('monhoc.create', compact('nganhs'));
    }

    // Lưu thông tin môn học mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maMonHoc' => 'required|string|max:10', // 'maMonHoc' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenMonHoc' => 'required|string|max:255', // 'tenMonHoc' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tạo mới môn học với dữ liệu từ request
        MonHoc::create($request->all());
        
        // Chuyển hướng đến trang danh sách môn học và thông báo thành công
        return redirect()->route('monhoc.index')->with('success', 'Môn học đã được thêm thành công');
    }

    // Hiển thị form để chỉnh sửa thông tin môn học
    public function edit($id)
    {
        // Tìm môn học theo ID
        $monHoc = MonHoc::find($id);
        // Lấy tất cả các ngành để hiển thị trong dropdown
        $nganhs = Nganh::select('id', 'tenNganh')->get();

        // Nếu tìm thấy môn học, trả về view 'monhoc.edit' với dữ liệu môn học và ngành
        if ($monHoc) {
            return view('monhoc.edit', compact('monHoc', 'nganhs'));
        }
        
        // Nếu không tìm thấy môn học, chuyển hướng đến trang danh sách môn học và thông báo lỗi
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    // Cập nhật thông tin môn học
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maMonHoc' => 'required|string|max:10', // 'maMonHoc' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenMonHoc' => 'required|string|max:255', // 'tenMonHoc' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tìm môn học theo ID
        $monHoc = MonHoc::find($id);
        
        // Nếu tìm thấy môn học, cập nhật thông tin và chuyển hướng đến trang danh sách môn học với thông báo thành công
        if ($monHoc) {
            $monHoc->update($request->all());
            return redirect()->route('monhoc.index')->with('success', 'Môn học đã được cập nhật thành công');
        }
        
        // Nếu không tìm thấy môn học, chuyển hướng đến trang danh sách môn học và thông báo lỗi
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    // Xóa môn học
    public function destroy($id)
    {
        // Tìm môn học theo ID
        $monHoc = MonHoc::find($id);
        
        // Nếu tìm thấy môn học, xóa và chuyển hướng đến trang danh sách môn học với thông báo thành công
        if ($monHoc) {
            $monHoc->delete();
            return redirect()->route('monhoc.index')->with('success', 'Môn học đã được xóa thành công');
        }
        
        // Nếu không tìm thấy môn học, chuyển hướng đến trang danh sách môn học và thông báo lỗi
        return redirect()->route('monhoc.index')->with('error', 'Môn học không tồn tại');
    }

    // API JSON

    // Lấy danh sách môn học dưới dạng JSON với khả năng tìm kiếm
    public function apiIndex(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maMonHoc', 'tenMonHoc', và 'nganh_id'
        $query = MonHoc::select('id', 'maMonHoc', 'tenMonHoc', 'nganh_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã môn học hoặc tên môn học
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maMonHoc', 'LIKE', "%$search%")
                  ->orWhere('tenMonHoc', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $monHocs = $query->get();
        
        // Trả về dữ liệu môn học dưới dạng JSON với mã trạng thái 200
        return response()->json($monHocs, 200);
    }

    // Lấy thông tin môn học theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm môn học theo ID
        $monHoc = MonHoc::select('id', 'maMonHoc', 'tenMonHoc', 'nganh_id')->find($id);
        
        // Nếu tìm thấy môn học, trả về dữ liệu môn học dưới dạng JSON với mã trạng thái 200
        if ($monHoc) {
            return response()->json($monHoc, 200);
        }
        
        // Nếu không tìm thấy môn học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Tạo mới môn học và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maMonHoc' => 'required|string|max:10', // 'maMonHoc' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenMonHoc' => 'required|string|max:255', // 'tenMonHoc' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tạo mới môn học với dữ liệu từ request
        $monHoc = MonHoc::create($request->all());
        
        // Trả về dữ liệu môn học mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($monHoc, 201);
    }

    // Cập nhật thông tin môn học và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maMonHoc' => 'required|string|max:10', // 'maMonHoc' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenMonHoc' => 'required|string|max:255', // 'tenMonHoc' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'nganh_id' => 'required|exists:tb_Nganh,id', // 'nganh_id' là bắt buộc, phải tồn tại trong bảng 'tb_Nganh'
        ]);

        // Tìm môn học theo ID
        $monHoc = MonHoc::find($id);
        
        // Nếu tìm thấy môn học, cập nhật thông tin và trả về dữ liệu môn học cập nhật dưới dạng JSON với mã trạng thái 200
        if ($monHoc) {
            $monHoc->update($request->all());
            return response()->json($monHoc, 200);
        }
        
        // Nếu không tìm thấy môn học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Xóa môn học và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm môn học theo ID
        $monHoc = MonHoc::find($id);
        
        // Nếu tìm thấy môn học, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($monHoc) {
            $monHoc->delete();
            return response()->json(['message' => 'Môn học đã được xóa'], 200);
        }
        
        // Nếu không tìm thấy môn học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }
}