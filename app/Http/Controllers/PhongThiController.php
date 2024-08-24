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
use App\Models\PhongThi;
use App\Models\CaThi;

class PhongThiController extends Controller
{
    // Phương thức hiển thị danh sách phòng thi và lọc theo ca thi nếu có
    public function index(Request $request)
    {
        // Lấy tham số 'cathi_id' từ request
        $cathiId = $request->input('cathi_id');
        
        // Khởi tạo query builder để truy vấn bảng PhongThi
        $query = PhongThi::query();

        // Nếu có 'cathi_id', thêm điều kiện vào query để lọc theo 'cathi_id'
        if ($cathiId) {
            $query->where('cathi_id', $cathiId);
        }

        // Thực hiện truy vấn và lấy danh sách phòng thi
        $phongThis = $query->get();
        
        // Lấy danh sách tất cả các ca thi để hiển thị trong dropdown
        $caThis = CaThi::all();
        
        // Trả về view 'phongthi.index' với dữ liệu phòng thi, ca thi và 'cathi_id'
        return view('phongthi.index', compact('phongThis', 'caThis', 'cathiId'));
    }

    // Phương thức hiển thị form để tạo mới phòng thi
    public function create()
    {
        // Lấy danh sách tất cả các ca thi để hiển thị trong dropdown
        $caThis = CaThi::all();
        
        // Trả về view 'phongthi.create' với dữ liệu các ca thi
        return view('phongthi.create', compact('caThis'));
    }

    // Phương thức lưu phòng thi mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255', // 'tenPhongThi' là tùy chọn, phải là chuỗi, tối đa 255 ký tự
            'danhSachSinhVien' => 'nullable|json', // 'danhSachSinhVien' là tùy chọn, phải là định dạng JSON
            'cathi_id' => 'required|exists:tb_CaThi,id', // 'cathi_id' là bắt buộc, phải tồn tại trong bảng 'tb_CaThi'
        ]);

        // Tạo mới phòng thi với dữ liệu từ request
        $phongThi = PhongThi::create($request->all());
        
        // Chuyển hướng đến trang danh sách phòng thi với thông báo thành công
        return redirect()->route('phongthi.index')->with('success', 'Phòng Thi added successfully');
    }

    // Phương thức hiển thị form để chỉnh sửa phòng thi
    public function edit($id)
    {
        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, lấy danh sách các ca thi và trả về view 'phongthi.edit' với dữ liệu phòng thi và ca thi
        if ($phongThi) {
            $caThis = CaThi::all();
            return view('phongthi.edit', compact('phongThi', 'caThis'));
        }
        
        // Nếu không tìm thấy phòng thi, chuyển hướng đến trang danh sách phòng thi với thông báo lỗi
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    // Phương thức cập nhật thông tin phòng thi
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255', // 'tenPhongThi' là tùy chọn, phải là chuỗi, tối đa 255 ký tự
            'danhSachSinhVien' => 'nullable|json', // 'danhSachSinhVien' là tùy chọn, phải là định dạng JSON
            'cathi_id' => 'required|exists:tb_CaThi,id', // 'cathi_id' là bắt buộc, phải tồn tại trong bảng 'tb_CaThi'
        ]);

        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, cập nhật thông tin và chuyển hướng đến trang danh sách phòng thi với thông báo thành công
        if ($phongThi) {
            $phongThi->update($request->all());
            return redirect()->route('phongthi.index')->with('success', 'Phòng Thi updated successfully');
        }
        
        // Nếu không tìm thấy phòng thi, chuyển hướng đến trang danh sách phòng thi với thông báo lỗi
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    // Phương thức xóa phòng thi
    public function destroy($id)
    {
        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, xóa và chuyển hướng đến trang danh sách phòng thi với thông báo thành công
        if ($phongThi) {
            $phongThi->delete();
            return redirect()->route('phongthi.index')->with('success', 'Phòng Thi deleted successfully');
        }
        
        // Nếu không tìm thấy phòng thi, chuyển hướng đến trang danh sách phòng thi với thông báo lỗi
        return redirect()->route('phongthi.index')->with('error', 'Phòng Thi not found');
    }

    // API JSON Methods

    // Phương thức lấy danh sách phòng thi dưới dạng JSON với khả năng lọc theo ca thi
    public function apiIndex(Request $request)
    {
        // Khởi tạo query builder để truy vấn bảng PhongThi
        $query = PhongThi::query();
    
        // Kiểm tra nếu có tham số 'kythi_id'
        if ($request->has('kythi')) {
            $kythi_id = $request->input('kythi');
            $query->whereHas('caThi', function ($q) use ($kythi_id) {
                $q->where('kythi_id', $kythi_id);
            });
        }
    
        // Kiểm tra nếu có tham số 'cathi_id'
        if ($request->has('cathi')) {
            $cathi_id = $request->input('cathi');
            $query->where('cathi_id', $cathi_id);
        }
    
        // Kiểm tra nếu có tham số 'search'
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tenPhongThi', 'LIKE', "%$search%");
        }
    
        // Thực hiện truy vấn và lấy danh sách phòng thi
        $phongThis = $query->get();
        
                // nếu không có kết quả
        if ($phongThis->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        }

        // Trả về dữ liệu phòng thi dưới dạng JSON với mã trạng thái 200
        return response()->json($phongThis, 200);
    }
    

    // Phương thức lấy thông tin phòng thi theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, trả về dữ liệu phòng thi dưới dạng JSON với mã trạng thái 200
        if ($phongThi) {
            return response()->json($phongThi, 200);
        }
        
        // Nếu không tìm thấy phòng thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiShow'], 404);
    }

    // Phương thức tạo phòng thi mới và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255', // 'tenPhongThi' là tùy chọn, phải là chuỗi, tối đa 255 ký tự
            'danhSachSinhVien' => 'nullable|json', // 'danhSachSinhVien' là tùy chọn, phải là định dạng JSON
            'cathi_id' => 'required|exists:tb_CaThi,id', // 'cathi_id' là bắt buộc, phải tồn tại trong bảng 'tb_CaThi'
        ]);

        // Tạo mới phòng thi với dữ liệu từ request
        $phongThi = PhongThi::create($request->all());
        
        // Trả về dữ liệu phòng thi mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($phongThi, 201);
    }

    // Phương thức cập nhật thông tin phòng thi và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'tenPhongThi' => 'nullable|string|max:255', // 'tenPhongThi' là tùy chọn, phải là chuỗi, tối đa 255 ký tự
            'danhSachSinhVien' => 'nullable|json', // 'danhSachSinhVien' là tùy chọn, phải là định dạng JSON
            'cathi_id' => 'required|exists:tb_CaThi,id', // 'cathi_id' là bắt buộc, phải tồn tại trong bảng 'tb_CaThi'
        ]);

        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, cập nhật thông tin và trả về dữ liệu dưới dạng JSON với mã trạng thái 200
        if ($phongThi) {
            $phongThi->update($request->all());
            return response()->json($phongThi, 200);
        }
        
        // Nếu không tìm thấy phòng thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiUpdate'], 404);
    }

    // Phương thức xóa phòng thi và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm phòng thi theo ID
        $phongThi = PhongThi::find($id);
        
        // Nếu tìm thấy phòng thi, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($phongThi) {
            $phongThi->delete();
            return response()->json(['message' => 'Phòng Thi deleted'], 200);
        }
        
        // Nếu không tìm thấy phòng thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found apiDestroy'], 404);
    }
}