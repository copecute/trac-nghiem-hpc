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
use App\Models\Nganh;
use App\Models\Khoa;

class NganhController extends Controller
{
    // Web Methods

    // Hiển thị danh sách các ngành học
    public function index()
    {
        // Lấy danh sách các ngành học cùng với thông tin khoa (khoa là quan hệ đã được định nghĩa trong mô hình Nganh)
        $nganhs = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id')->get();
        
        // Trả về view 'nganh.index' và truyền dữ liệu các ngành học vào view
        return view('nganh.index', compact('nganhs'));
    }

    // Tìm kiếm ngành học theo từ khóa
    public function search(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maNganh', 'tenNganh', và 'khoa_id' cùng với thông tin khoa
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã ngành hoặc tên ngành
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $nganhs = $query->get();
        
        // Trả về view 'nganh.index' và truyền dữ liệu các ngành học vào view
        return view('nganh.index', compact('nganhs'));
    }

    // Hiển thị form để tạo mới ngành học
    public function create()
    {
        // Lấy tất cả các khoa để hiển thị trong dropdown
        $khoas = Khoa::select('id', 'tenKhoa')->get();
        
        // Trả về view 'nganh.create' với dữ liệu các khoa
        return view('nganh.create', compact('khoas'));
    }

    // Lưu thông tin ngành học mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maNganh' => 'required|string|max:10', // 'maNganh' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenNganh' => 'required|string|max:255', // 'tenNganh' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'khoa_id' => 'required|exists:tb_Khoa,id', // 'khoa_id' là bắt buộc, phải tồn tại trong bảng 'tb_Khoa'
        ]);

        // Tạo mới ngành học với dữ liệu từ request
        Nganh::create($request->all());
        
        // Chuyển hướng đến trang danh sách ngành học và thông báo thành công
        return redirect()->route('nganh.index')->with('success', 'Ngành added successfully');
    }

    // Hiển thị form để chỉnh sửa thông tin ngành học
    public function edit($id)
    {
        // Tìm ngành học theo ID
        $nganh = Nganh::find($id);
        // Lấy tất cả các khoa để hiển thị trong dropdown
        $khoas = Khoa::select('id', 'tenKhoa')->get();

        // Nếu tìm thấy ngành học, trả về view 'nganh.edit' với dữ liệu ngành học và khoa
        if ($nganh) {
            return view('nganh.edit', compact('nganh', 'khoas'));
        }
        
        // Nếu không tìm thấy ngành học, chuyển hướng đến trang danh sách ngành học và thông báo lỗi
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    // Cập nhật thông tin ngành học
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maNganh' => 'required|string|max:10', // 'maNganh' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenNganh' => 'required|string|max:255', // 'tenNganh' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'khoa_id' => 'required|exists:tb_Khoa,id', // 'khoa_id' là bắt buộc, phải tồn tại trong bảng 'tb_Khoa'
        ]);

        // Tìm ngành học theo ID
        $nganh = Nganh::find($id);
        
        // Nếu tìm thấy ngành học, cập nhật thông tin và chuyển hướng đến trang danh sách ngành học với thông báo thành công
        if ($nganh) {
            $nganh->update($request->all());
            return redirect()->route('nganh.index')->with('success', 'Ngành updated successfully');
        }
        
        // Nếu không tìm thấy ngành học, chuyển hướng đến trang danh sách ngành học và thông báo lỗi
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    // Xóa ngành học
    public function destroy($id)
    {
        // Tìm ngành học theo ID
        $nganh = Nganh::find($id);
        
        // Nếu tìm thấy ngành học, xóa và chuyển hướng đến trang danh sách ngành học với thông báo thành công
        if ($nganh) {
            $nganh->delete();
            return redirect()->route('nganh.index')->with('success', 'Ngành deleted successfully');
        }
        
        // Nếu không tìm thấy ngành học, chuyển hướng đến trang danh sách ngành học và thông báo lỗi
        return redirect()->route('nganh.index')->with('error', 'Ngành not found');
    }

    // API JSON Methods

    // Lấy danh sách ngành học dưới dạng JSON với khả năng tìm kiếm
    public function apiIndex(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maNganh', 'tenNganh', và 'khoa_id' cùng với thông tin khoa
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');
    
        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã ngành hoặc tên ngành
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }
    
        // Nếu có tham số 'khoa', lọc kết quả theo 'khoa_id'
        if ($request->has('khoa')) {
            $khoa_id = $request->input('khoa');
            $query->where('khoa_id', $khoa_id);
        }
    
        // truy vấn và lấy kết quả
        $nganhs = $query->get();

        // nếu không có kết quả
        if ($nganhs->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        }

        // Trả về dữ liệu ngành học dưới dạng JSON với mã trạng thái 200
        return response()->json($nganhs, 200);
    }
    

    // Lấy thông tin ngành học theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm ngành học theo ID cùng với thông tin khoa
        $nganh = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id')->find($id);
        
        // Nếu tìm thấy ngành học, trả về dữ liệu ngành học dưới dạng JSON với mã trạng thái 200
        if ($nganh) {
            return response()->json($nganh, 200);
        }
        
        // Nếu không tìm thấy ngành học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Tạo mới ngành học và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maNganh' => 'required|string|max:10', // 'maNganh' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenNganh' => 'required|string|max:255', // 'tenNganh' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'khoa_id' => 'required|exists:tb_Khoa,id', // 'khoa_id' là bắt buộc, phải tồn tại trong bảng 'tb_Khoa'
        ]);

        // Tạo mới ngành học với dữ liệu từ request
        $nganh = Nganh::create($request->all());
        
        // Trả về dữ liệu ngành học mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($nganh, 201);
    }

    // Cập nhật thông tin ngành học và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'maNganh' => 'required|string|max:10', // 'maNganh' là bắt buộc, phải là chuỗi, tối đa 10 ký tự
            'tenNganh' => 'required|string|max:255', // 'tenNganh' là bắt buộc, phải là chuỗi, tối đa 255 ký tự
            'khoa_id' => 'required|exists:tb_Khoa,id', // 'khoa_id' là bắt buộc, phải tồn tại trong bảng 'tb_Khoa'
        ]);

        // Tìm ngành học theo ID
        $nganh = Nganh::find($id);
        
        // Nếu tìm thấy ngành học, cập nhật thông tin và trả về dữ liệu ngành học dưới dạng JSON với mã trạng thái 200
        if ($nganh) {
            $nganh->update($request->all());
            return response()->json($nganh, 200);
        }
        
        // Nếu không tìm thấy ngành học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Xóa ngành học và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm ngành học theo ID
        $nganh = Nganh::find($id);
        
        // Nếu tìm thấy ngành học, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($nganh) {
            $nganh->delete();
            return response()->json(['message' => 'Ngành deleted'], 200);
        }
        
        // Nếu không tìm thấy ngành học, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Tìm kiếm ngành học qua API
    public function apiSearch(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'maNganh', 'tenNganh', và 'khoa_id' cùng với thông tin khoa
        $query = Nganh::with('khoa')->select('id', 'maNganh', 'tenNganh', 'khoa_id');
    
        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query để tìm kiếm theo mã ngành hoặc tên ngành
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('maNganh', 'LIKE', "%$search%")
                  ->orWhere('tenNganh', 'LIKE', "%$search%");
        }
    
        // Thực hiện truy vấn và lấy kết quả
        $nganhs = $query->get();
        
        // Trả về dữ liệu ngành học dưới dạng JSON với mã trạng thái 200
        return response()->json($nganhs, 200);
    }
}