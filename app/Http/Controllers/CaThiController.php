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
use App\Models\CaThi;
use App\Models\MonHoc;

class CaThiController extends Controller
{
    // Hiển thị danh sách các Ca thi dựa trên kythi_id
    public function index($kythi_id) {
        $cathis = CaThi::where('kythi_id', $kythi_id)->get(); // Lấy tất cả các ca thi liên quan đến kythi_id
        $monhocs = MonHoc::all(); // Lấy tất cả các môn học
        return view('cathi.index', compact('cathis', 'kythi_id', 'monhocs')); // Trả về view danh sách ca thi
    }

    // Hiển thị form tạo mới Ca thi
    public function create($kythi_id) {
        $monhocs = MonHoc::all(); // Lấy tất cả các môn học
        return view('cathi.create', compact('kythi_id', 'monhocs')); // Trả về view tạo ca thi
    }

    // Xử lý lưu Ca thi mới
    public function store(Request $request, $kythi_id) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenCa' => 'nullable|string|max:255', // Tên ca có thể để trống, phải là chuỗi và tối đa 255 ký tự
            'thoiGianBatDau' => 'nullable|date', // Thời gian bắt đầu có thể để trống, phải là ngày hợp lệ
            'thoiGianKetThuc' => 'nullable|date', // Thời gian kết thúc có thể để trống, phải là ngày hợp lệ
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // Môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
        ]);

        // Tạo mới Ca thi và gán kythi_id
        CaThi::create(array_merge($request->all(), ['kythi_id' => $kythi_id]));
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi thêm thành công');
    }

    // Hiển thị form chỉnh sửa Ca thi
    public function edit($kythi_id, $id) {
        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi) {
            $monhocs = MonHoc::all(); // Lấy tất cả các môn học
            return view('cathi.edit', compact('cathi', 'kythi_id', 'monhocs')); // Trả về view chỉnh sửa ca thi
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi không tồn tại');
    }

    // Xử lý cập nhật Ca thi
    public function update(Request $request, $kythi_id, $id) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenCa' => 'nullable|string|max:255', // Tên ca có thể để trống, phải là chuỗi và tối đa 255 ký tự
            'thoiGianBatDau' => 'nullable|date', // Thời gian bắt đầu có thể để trống, phải là ngày hợp lệ
            'thoiGianKetThuc' => 'nullable|date', // Thời gian kết thúc có thể để trống, phải là ngày hợp lệ
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // Môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
        ]);

        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi) {
            $cathi->update($request->all()); // Cập nhật thông tin Ca thi
            return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi cập nhật thành công');
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi không tồn tại');
    }

    // Xử lý xóa Ca thi
    public function destroy($kythi_id, $id) {
        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi) {
            $cathi->delete(); // Xóa Ca thi
            return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('success', 'Ca thi đã được xóa thành công');
        }
        return redirect()->route('cathi.index', ['kythi_id' => $kythi_id])->with('error', 'Ca thi không tồn tại');
    }

    // API JSON: Lấy danh sách các Ca thi dựa trên kythi_id
    public function apiIndex($kythi_id) {
        return response()->json(CaThi::where('kythi_id', $kythi_id)->get(), 200); // Trả về JSON danh sách các ca thi
    }

    // API JSON: Lưu Ca thi mới
    public function apiStore(Request $request, $kythi_id) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenCa' => 'nullable|string|max:255', // Tên ca có thể để trống, phải là chuỗi và tối đa 255 ký tự
            'thoiGianBatDau' => 'nullable|date', // Thời gian bắt đầu có thể để trống, phải là ngày hợp lệ
            'thoiGianKetThuc' => 'nullable|date', // Thời gian kết thúc có thể để trống, phải là ngày hợp lệ
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // Môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
        ]);

        $cathi = CaThi::create(array_merge($request->all(), ['kythi_id' => $kythi_id])); // Tạo mới Ca thi
        return response()->json($cathi, 201); // Trả về JSON của ca thi mới tạo với mã trạng thái 201
    }

    // API JSON: Hiển thị thông tin chi tiết Ca thi
    public function apiShow($kythi_id, $id) {
        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            return response()->json($cathi, 200); // Trả về JSON chi tiết ca thi nếu tìm thấy
        }
        return response()->json(['message' => 'Không tìm thấy'], 404); // Trả về thông báo lỗi nếu không tìm thấy
    }

    // API JSON: Cập nhật Ca thi
    public function apiUpdate(Request $request, $kythi_id, $id) {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenCa' => 'nullable|string|max:255', // Tên ca có thể để trống, phải là chuỗi và tối đa 255 ký tự
            'thoiGianBatDau' => 'nullable|date', // Thời gian bắt đầu có thể để trống, phải là ngày hợp lệ
            'thoiGianKetThuc' => 'nullable|date', // Thời gian kết thúc có thể để trống, phải là ngày hợp lệ
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // Môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
        ]);

        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            $cathi->update($request->all()); // Cập nhật thông tin Ca thi
            return response()->json($cathi, 200); // Trả về JSON của ca thi sau khi cập nhật
        }
        return response()->json(['message' => 'Không tìm thấy'], 404); // Trả về thông báo lỗi nếu không tìm thấy
    }

    // API JSON: Xóa Ca thi
    public function apiDestroy($kythi_id, $id) {
        $cathi = CaThi::find($id); // Tìm Ca thi theo id
        if ($cathi && $cathi->kythi_id == $kythi_id) {
            $cathi->delete(); // Xóa Ca thi
            return response()->json(['message' => 'Ca thi đã được xóa'], 200); // Trả về thông báo thành công
        }
        return response()->json(['message' => 'Không tìm thấy'], 404); // Trả về thông báo lỗi nếu không tìm thấy
    }
}