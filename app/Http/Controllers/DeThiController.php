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
use App\Models\DeThi;
use App\Models\MonHoc;
use App\Models\CaThi;

class DeThiController extends Controller
{
    // Hiển thị danh sách các đề thi theo ID ca thi
    public function index(Request $request)
    {
        $caThiId = $request->get('cathi_id'); // Lấy ID ca thi từ request

        // Lấy tất cả các đề thi với thông tin môn học và ca thi liên quan
        $deThis = DeThi::with('monHoc', 'caThi')
            ->where('cathi_id', $caThiId) // Lọc theo ID ca thi
            ->get();

        // Lấy tất cả các ca thi và môn học để sử dụng trong view
        $caThis = CaThi::all();
        $monHocs = MonHoc::all();

        // Trả về view danh sách đề thi với dữ liệu cần thiết
        return view('dethi.index', compact('deThis', 'caThiId', 'caThis', 'monHocs'));
    }

    // Hiển thị form để tạo đề thi mới
    public function create()
    {
        // Lấy tất cả các ca thi và môn học để hiển thị trong form tạo đề thi
        $caThis = CaThi::all();
        $monHocs = MonHoc::all();

        // Trả về view tạo đề thi với dữ liệu cần thiết
        return view('dethi.create', compact('caThis', 'monHocs'));
    }

    // Lưu trữ đề thi mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenDe' => 'nullable|string|max:255', // Tên đề thi có thể trống và tối đa 255 ký tự
            'soLuongCauHoi' => 'nullable|integer', // Số lượng câu hỏi có thể trống và phải là số nguyên
            'tiLeKho' => 'nullable|integer', // Tỉ lệ khó có thể trống và phải là số nguyên
            'tiLeTrungBinh' => 'nullable|integer', // Tỉ lệ trung bình có thể trống và phải là số nguyên
            'tiLeDe' => 'nullable|integer', // Tỉ lệ dễ có thể trống và phải là số nguyên
            'cauHoi' => 'nullable|json', // Câu hỏi có thể trống và phải ở định dạng JSON
            'thoiGian' => 'nullable|integer', // Thời gian có thể trống và phải là số nguyên
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
            'cathi_id' => 'required|exists:tb_CaThi,id', // ID ca thi là bắt buộc và phải tồn tại trong bảng tb_CaThi
        ]);

        // Tạo mới đề thi với dữ liệu đã xác thực
        DeThi::create($request->all());
        // Chuyển hướng về trang danh sách đề thi với thông báo thành công
        return redirect()->route('dethi.index', ['cathi_id' => $request->cathi_id])->with('success', 'Đề thi đã được thêm thành công');
    }

    // Hiển thị form để chỉnh sửa đề thi
    public function edit($id)
    {
        // Tìm đề thi dựa trên ID
        $deThi = DeThi::find($id);

        // Nếu tìm thấy đề thi, lấy dữ liệu ca thi và môn học và trả về view chỉnh sửa đề thi
        if ($deThi) {
            $caThis = CaThi::all();
            $monHocs = MonHoc::all();
            return view('dethi.edit', compact('deThi', 'caThis', 'monHocs'));
        }

        // Nếu không tìm thấy đề thi, chuyển hướng về trang danh sách với thông báo lỗi
        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    // Cập nhật thông tin một đề thi
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenDe' => 'nullable|string|max:255', // Tên đề thi có thể trống và tối đa 255 ký tự
            'soLuongCauHoi' => 'nullable|integer', // Số lượng câu hỏi có thể trống và phải là số nguyên
            'tiLeKho' => 'nullable|integer', // Tỉ lệ khó có thể trống và phải là số nguyên
            'tiLeTrungBinh' => 'nullable|integer', // Tỉ lệ trung bình có thể trống và phải là số nguyên
            'tiLeDe' => 'nullable|integer', // Tỉ lệ dễ có thể trống và phải là số nguyên
            'cauHoi' => 'nullable|json', // Câu hỏi có thể trống và phải ở định dạng JSON
            'thoiGian' => 'nullable|integer', // Thời gian có thể trống và phải là số nguyên
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
            'cathi_id' => 'required|exists:tb_CaThi,id', // ID ca thi là bắt buộc và phải tồn tại trong bảng tb_CaThi
        ]);

        // Tìm đề thi dựa trên ID
        $deThi = DeThi::find($id);
        if ($deThi) {
            // Cập nhật thông tin đề thi với dữ liệu đã xác thực
            $deThi->update($request->all());
            // Chuyển hướng về trang danh sách đề thi với thông báo thành công
            return redirect()->route('dethi.index', ['cathi_id' => $deThi->cathi_id])->with('success', 'Đề thi đã được cập nhật thành công');
        }

        // Nếu không tìm thấy đề thi, chuyển hướng về trang danh sách với thông báo lỗi
        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    // Xóa một đề thi khỏi cơ sở dữ liệu
    public function destroy($id)
    {
        // Tìm đề thi dựa trên ID
        $deThi = DeThi::find($id);
        if ($deThi) {
            // Xóa đề thi và chuyển hướng về trang danh sách với thông báo thành công
            $deThi->delete();
            return redirect()->route('dethi.index', ['cathi_id' => $deThi->cathi_id])->with('success', 'Đề thi đã được xóa thành công');
        }

        // Nếu không tìm thấy đề thi, chuyển hướng về trang danh sách với thông báo lỗi
        return redirect()->route('dethi.index')->with('error', 'Đề thi không tồn tại');
    }

    // API JSON: Lấy danh sách các đề thi theo ID ca thi
    public function apiIndex(Request $request)
    {
        $caThiId = $request->get('cathi_id'); // Lấy ID ca thi từ request

        // Lấy tất cả các đề thi với thông tin môn học và ca thi liên quan
        $query = DeThi::with('monHoc', 'caThi')
            ->where('cathi_id', $caThiId); // Lọc theo ID ca thi

        $deThis = $query->get(); // Thực hiện truy vấn và lấy dữ liệu
        // Trả về dữ liệu dưới dạng JSON với mã trạng thái 200
        return response()->json($deThis, 200);
    }

    // API JSON: Lấy thông tin một đề thi theo ID
    public function apiShow($id)
    {
        // Tìm đề thi dựa trên ID và kèm theo thông tin môn học và ca thi liên quan
        $deThi = DeThi::with('monHoc', 'caThi')->find($id);
        if ($deThi) {
            // Nếu tìm thấy, trả về dữ liệu dưới dạng JSON với mã trạng thái 200
            return response()->json($deThi, 200);
        }
        // Nếu không tìm thấy, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // API JSON: Lưu trữ đề thi mới vào cơ sở dữ liệu
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenDe' => 'nullable|string|max:255', // Tên đề thi có thể trống và tối đa 255 ký tự
            'soLuongCauHoi' => 'nullable|integer', // Số lượng câu hỏi có thể trống và phải là số nguyên
            'tiLeKho' => 'nullable|integer', // Tỉ lệ khó có thể trống và phải là số nguyên
            'tiLeTrungBinh' => 'nullable|integer', // Tỉ lệ trung bình có thể trống và phải là số nguyên
            'tiLeDe' => 'nullable|integer', // Tỉ lệ dễ có thể trống và phải là số nguyên
            'cauHoi' => 'nullable|json', // Câu hỏi có thể trống và phải ở định dạng JSON
            'thoiGian' => 'nullable|integer', // Thời gian có thể trống và phải là số nguyên
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
            'cathi_id' => 'required|exists:tb_CaThi,id', // ID ca thi là bắt buộc và phải tồn tại trong bảng tb_CaThi
        ]);

        // Tạo mới đề thi với dữ liệu đã xác thực
        $deThi = DeThi::create($request->all());
        // Trả về dữ liệu đề thi đã tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($deThi, 201);
    }

    // API JSON: Cập nhật thông tin một đề thi
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenDe' => 'nullable|string|max:255', // Tên đề thi có thể trống và tối đa 255 ký tự
            'soLuongCauHoi' => 'nullable|integer', // Số lượng câu hỏi có thể trống và phải là số nguyên
            'tiLeKho' => 'nullable|integer', // Tỉ lệ khó có thể trống và phải là số nguyên
            'tiLeTrungBinh' => 'nullable|integer', // Tỉ lệ trung bình có thể trống và phải là số nguyên
            'tiLeDe' => 'nullable|integer', // Tỉ lệ dễ có thể trống và phải là số nguyên
            'cauHoi' => 'nullable|json', // Câu hỏi có thể trống và phải ở định dạng JSON
            'thoiGian' => 'nullable|integer', // Thời gian có thể trống và phải là số nguyên
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học là bắt buộc và phải tồn tại trong bảng tb_MonHoc
            'cathi_id' => 'required|exists:tb_CaThi,id', // ID ca thi là bắt buộc và phải tồn tại trong bảng tb_CaThi
        ]);

        // Tìm đề thi dựa trên ID
        $deThi = DeThi::find($id);
        if ($deThi) {
            // Cập nhật thông tin đề thi với dữ liệu đã xác thực
            $deThi->update($request->all());
            // Trả về dữ liệu đề thi đã cập nhật dưới dạng JSON với mã trạng thái 200
            return response()->json($deThi, 200);
        }
        // Nếu không tìm thấy đề thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // API JSON: Xóa một đề thi
    public function apiDestroy($id)
    {
        // Tìm đề thi dựa trên ID
        $deThi = DeThi::find($id);
        if ($deThi) {
            // Xóa đề thi và trả về thông báo thành công dưới dạng JSON với mã trạng thái 200
            $deThi->delete();
            return response()->json(['message' => 'Đề thi đã được xóa'], 200);
        }
        // Nếu không tìm thấy đề thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }
}