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
use App\Models\SinhVien;
use App\Models\Lop;
use Illuminate\Support\Facades\Hash;

class SinhVienController extends Controller
{
    // Phương thức hiển thị danh sách sinh viên
    public function index()
    {
        // Lấy danh sách sinh viên cùng với thông tin lớp (sử dụng eager loading để giảm số lượng truy vấn)
        $sinhViens = SinhVien::with('lop')->get();
        // Trả về view 'sinhvien.index' với dữ liệu sinhViens
        return view('sinhvien.index', compact('sinhViens'));
    }

    // Phương thức tìm kiếm sinh viên
    public function search(Request $request)
    {
        // Tạo truy vấn để lấy danh sách sinh viên cùng với thông tin lớp
        $query = SinhVien::with('lop');

        // Nếu có từ khóa tìm kiếm, áp dụng điều kiện tìm kiếm
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        // Thực thi truy vấn và lấy kết quả
        $sinhViens = $query->get();
        // Trả về view 'sinhvien.index' với dữ liệu sinhViens
        return view('sinhvien.index', compact('sinhViens'));
    }

    // Phương thức hiển thị form tạo mới sinh viên
    public function create()
    {
        // Lấy danh sách lớp để chọn trong form tạo mới
        $lops = Lop::select('id', 'tenLop')->get();
        // Trả về view 'sinhvien.create' với dữ liệu lops
        return view('sinhvien.create', compact('lops'));
    }

    // Phương thức lưu sinh viên mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien', // Mã sinh viên là bắt buộc, duy nhất
            'matKhau' => 'required|string|min:8', // Mật khẩu là bắt buộc, tối thiểu 8 ký tự
            'hoTen' => 'required|string|max:255', // Họ tên là bắt buộc
            'ngaySinh' => 'required|date', // Ngày sinh là bắt buộc và phải là định dạng ngày
            'gioiTinh' => 'required|string|max:10', // Giới tính là bắt buộc
            'diaChi' => 'required|string|max:255', // Địa chỉ là bắt buộc
            'sdt' => 'required|string|max:15', // Số điện thoại là bắt buộc
            'email' => 'required|string|email|max:255|unique:tb_SinhVien', // Email là bắt buộc, phải là định dạng email và duy nhất
            'lop_id' => 'required|exists:tb_Lop,id', // ID lớp là bắt buộc và phải tồn tại trong bảng tb_Lop
        ]);
    
        // Tạo sinh viên mới với dữ liệu đã xác thực
        SinhVien::create([
            'maSV' => $request->maSV,
            'matKhau' => Hash::make($request->matKhau), // Mã hóa mật khẩu
            'hoTen' => $request->hoTen,
            'ngaySinh' => $request->ngaySinh,
            'gioiTinh' => $request->gioiTinh,
            'diaChi' => $request->diaChi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'lop_id' => $request->lop_id,
        ]);
    
        // Chuyển hướng về danh sách sinh viên với thông báo thành công
        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được thêm thành công');
    }

    // Phương thức hiển thị form chỉnh sửa sinh viên
    public function edit($id)
    {
        // Tìm sinh viên theo ID
        $sinhVien = SinhVien::find($id);
        // Lấy danh sách lớp để chọn trong form chỉnh sửa
        $lops = Lop::select('id', 'tenLop')->get();

        // Nếu sinh viên tồn tại, trả về view 'sinhvien.edit' với dữ liệu sinhVien và lops
        if ($sinhVien) {
            return view('sinhvien.edit', compact('sinhVien', 'lops'));
        }

        // Nếu không tìm thấy sinh viên, chuyển hướng về danh sách sinh viên với thông báo lỗi
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    // Phương thức cập nhật thông tin sinh viên
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien,maSV,' . $id, // Mã sinh viên là bắt buộc, duy nhất ngoại trừ bản ghi hiện tại
            'matKhau' => 'nullable|string|min:6', // Mật khẩu có thể là null và tối thiểu 6 ký tự
            'hoTen' => 'required|string|max:255', // Họ tên là bắt buộc
            'ngaySinh' => 'required|date', // Ngày sinh là bắt buộc và phải là định dạng ngày
            'gioiTinh' => 'required|string|max:10', // Giới tính là bắt buộc
            'diaChi' => 'required|string|max:255', // Địa chỉ là bắt buộc
            'sdt' => 'required|string|max:15', // Số điện thoại là bắt buộc
            'email' => 'required|string|email|max:255|unique:tb_SinhVien,email,' . $id, // Email là bắt buộc, phải là định dạng email và duy nhất ngoại trừ bản ghi hiện tại
            'lop_id' => 'required|exists:tb_Lop,id', // ID lớp là bắt buộc và phải tồn tại trong bảng tb_Lop
        ]);
    
        // Tìm sinh viên theo ID
        $sinhVien = SinhVien::find($id);
    
        // Nếu sinh viên tồn tại, cập nhật thông tin
        if ($sinhVien) {
            $sinhVien->update([
                'maSV' => $request->maSV,
                'hoTen' => $request->hoTen,
                'ngaySinh' => $request->ngaySinh,
                'gioiTinh' => $request->gioiTinh,
                'diaChi' => $request->diaChi,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'lop_id' => $request->lop_id,
            ]);
    
            // Cập nhật mật khẩu chỉ nếu có thay đổi
            if ($request->filled('matKhau')) {
                $sinhVien->update(['matKhau' => Hash::make($request->matKhau)]);
            }
    
            // Chuyển hướng về danh sách sinh viên với thông báo thành công
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được cập nhật thành công');
        }
    
        // Nếu không tìm thấy sinh viên, chuyển hướng về danh sách sinh viên với thông báo lỗi
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    // Phương thức xóa sinh viên
    public function destroy($id)
    {
        // Tìm sinh viên theo ID
        $sinhVien = SinhVien::find($id);

        // Nếu sinh viên tồn tại, xóa bản ghi
        if ($sinhVien) {
            $sinhVien->delete();
            // Chuyển hướng về danh sách sinh viên với thông báo thành công
            return redirect()->route('sinhvien.index')->with('success', 'Sinh viên đã được xóa thành công');
        }

        // Nếu không tìm thấy sinh viên, chuyển hướng về danh sách sinh viên với thông báo lỗi
        return redirect()->route('sinhvien.index')->with('error', 'Sinh viên không tìm thấy');
    }

    // API JSON - Lấy danh sách sinh viên
    public function apiIndex(Request $request)
    {
        // Tạo truy vấn để lấy danh sách sinh viên cùng với thông tin lớp
        $query = SinhVien::with('lop');

        // Nếu có từ khóa tìm kiếm, áp dụng điều kiện tìm kiếm
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        // Thực thi truy vấn và lấy kết quả
        $sinhViens = $query->get();
        // Trả về dữ liệu sinhViens dưới dạng JSON với mã trạng thái 200 (OK)
        return response()->json($sinhViens, 200);
    }

    // API JSON - Lấy thông tin sinh viên theo ID
    public function apiShow($id)
    {
        // Tìm sinh viên theo ID cùng với thông tin lớp
        $sinhVien = SinhVien::with('lop')->find($id);
        if ($sinhVien) {
            // Trả về thông tin sinh viên dưới dạng JSON với mã trạng thái 200 (OK)
            return response()->json($sinhVien, 200);
        }

        // Nếu không tìm thấy sinh viên, trả về thông báo lỗi với mã trạng thái 404 (Not Found)
        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    // API JSON - Lưu sinh viên mới
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien', // Mã sinh viên là bắt buộc, duy nhất
            'matKhau' => 'required|string|max:255', // Mật khẩu là bắt buộc
            'hoTen' => 'required|string|max:255', // Họ tên là bắt buộc
            'ngaySinh' => 'required|date', // Ngày sinh là bắt buộc và phải là định dạng ngày
            'gioiTinh' => 'required|string|max:10', // Giới tính là bắt buộc
            'diaChi' => 'required|string|max:255', // Địa chỉ là bắt buộc
            'sdt' => 'required|string|max:15', // Số điện thoại là bắt buộc
            'email' => 'required|string|email|max:255|unique:tb_SinhVien', // Email là bắt buộc, phải là định dạng email và duy nhất
            'lop_id' => 'required|exists:tb_Lop,id', // ID lớp là bắt buộc và phải tồn tại trong bảng tb_Lop
        ]);

        // Tạo sinh viên mới với dữ liệu đã xác thực
        $sinhVien = SinhVien::create([
            'maSV' => $request->maSV,
            'hoTen' => $request->hoTen,
            'ngaySinh' => $request->ngaySinh,
            'gioiTinh' => $request->gioiTinh,
            'diaChi' => $request->diaChi,
            'sdt' => $request->sdt,
            'email' => $request->email,
            'lop_id' => $request->lop_id,
            'matKhau' => Hash::make($request->matKhau), // Mã hóa mật khẩu
        ]);

        // Trả về thông tin sinh viên mới tạo dưới dạng JSON với mã trạng thái 201 (Created)
        return response()->json($sinhVien, 201);
    }

    // API JSON - Cập nhật thông tin sinh viên
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào từ request
        $request->validate([
            'maSV' => 'required|string|max:10|unique:tb_SinhVien,maSV,' . $id, // Mã sinh viên là bắt buộc, duy nhất ngoại trừ bản ghi hiện tại
            'hoTen' => 'required|string|max:255', // Họ tên là bắt buộc
            'ngaySinh' => 'required|date', // Ngày sinh là bắt buộc và phải là định dạng ngày
            'gioiTinh' => 'required|string|max:10', // Giới tính là bắt buộc
            'diaChi' => 'required|string|max:255', // Địa chỉ là bắt buộc
            'sdt' => 'required|string|max:15', // Số điện thoại là bắt buộc
            'email' => 'required|string|email|max:255|unique:tb_SinhVien,email,' . $id, // Email là bắt buộc, phải là định dạng email và duy nhất ngoại trừ bản ghi hiện tại
            'lop_id' => 'required|exists:tb_Lop,id', // ID lớp là bắt buộc và phải tồn tại trong bảng tb_Lop
        ]);

        // Tìm sinh viên theo ID
        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            // Cập nhật thông tin sinh viên
            $sinhVien->update([
                'maSV' => $request->maSV,
                'hoTen' => $request->hoTen,
                'ngaySinh' => $request->ngaySinh,
                'gioiTinh' => $request->gioiTinh,
                'diaChi' => $request->diaChi,
                'sdt' => $request->sdt,
                'email' => $request->email,
                'lop_id' => $request->lop_id,
            ]);

            // Trả về thông tin sinh viên đã cập nhật dưới dạng JSON với mã trạng thái 200 (OK)
            return response()->json($sinhVien, 200);
        }

        // Nếu không tìm thấy sinh viên, trả về thông báo lỗi với mã trạng thái 404 (Not Found)
        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    // API JSON - Xóa sinh viên
    public function apiDestroy($id)
    {
        // Tìm sinh viên theo ID
        $sinhVien = SinhVien::find($id);
        if ($sinhVien) {
            // Xóa sinh viên
            $sinhVien->delete();
            // Trả về thông báo xóa thành công dưới dạng JSON với mã trạng thái 200 (OK)
            return response()->json(['message' => 'Sinh viên đã được xóa'], 200);
        }

        // Nếu không tìm thấy sinh viên, trả về thông báo lỗi với mã trạng thái 404 (Not Found)
        return response()->json(['message' => 'Không tìm thấy'], 404);
    }

    // API JSON - Tìm kiếm sinh viên
    public function apiSearch(Request $request)
    {
        // Tạo truy vấn để lấy danh sách sinh viên cùng với thông tin lớp
        $query = SinhVien::with('lop');

        // Nếu có từ khóa tìm kiếm, áp dụng điều kiện tìm kiếm
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('maSV', 'LIKE', "%$search%")
                  ->orWhere('hoTen', 'LIKE', "%$search%")
                  ->orWhere('email', 'LIKE', "%$search%");
        }

        // Thực thi truy vấn và lấy kết quả
        $sinhViens = $query->get();
        // Trả về dữ liệu sinhViens dưới dạng JSON với mã trạng thái 200 (OK)
        return response()->json($sinhViens, 200);
    }
}