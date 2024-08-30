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
use App\Models\CauHoi;
use App\Models\MonHoc;

class CauHoiController extends Controller
{
    // Views

    // Phương thức hiển thị danh sách các câu hỏi
    public function index()
    {
        // Lấy tất cả các câu hỏi kèm theo thông tin môn học tương ứng
        $cauHois = CauHoi::with('monhoc:id,tenMonHoc') // Thêm quan hệ với môn học để lấy tên môn học
                        ->select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id') // Chỉ chọn các cột cần thiết
                        ->get();
        // Trả về view 'cauhoi.index' kèm theo danh sách câu hỏi
        return view('cauhoi.index', compact('cauHois'));
    }

    // Phương thức tìm kiếm câu hỏi theo nội dung hoặc tên môn học
    public function search(Request $request)
    {
        // Tạo truy vấn để lấy các câu hỏi kèm theo thông tin môn học
        $query = CauHoi::with('monhoc:id,tenMonHoc') // Thêm quan hệ với môn học để lấy tên môn học
                       ->select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id'); // Chỉ chọn các cột cần thiết

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search'); // Lấy từ khóa tìm kiếm từ request
            $query->where('noiDung', 'LIKE', "%$search%") // Tìm kiếm theo nội dung câu hỏi
                  ->orWhereHas('monhoc', function ($query) use ($search) { // Tìm kiếm theo tên môn học
                      $query->where('tenMonHoc', 'LIKE', "%$search%");
                  });
        }

        // Thực hiện truy vấn và lấy kết quả
        $cauHois = $query->get();
        // Trả về view 'cauhoi.index' kèm theo danh sách câu hỏi sau khi tìm kiếm
        return view('cauhoi.index', compact('cauHois'));
    }

    // Phương thức hiển thị trang tạo câu hỏi mới
    public function create()
    {
        // Lấy danh sách tất cả môn học để chọn khi tạo câu hỏi
        $monhocs = MonHoc::select('id', 'tenMonHoc')->get();
        // Trả về view 'cauhoi.create' kèm theo danh sách môn học
        return view('cauhoi.create', compact('monhocs'));
    }

    // Phương thức lưu câu hỏi mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'noiDung' => 'nullable|string', // Nội dung câu hỏi có thể trống và phải là chuỗi
            'typeAudio' => 'nullable|string|max:255', // Loại audio có thể trống và tối đa 255 ký tự
            'typeVideo' => 'nullable|string|max:255', // Loại video có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'doKho' => 'nullable|integer|min:1|max:5', // Độ khó của câu hỏi là số nguyên từ 1 đến 5
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học phải tồn tại trong bảng tb_MonHoc
        ]);

        // Tạo câu hỏi mới với dữ liệu đã xác thực
        CauHoi::create($request->all());
        // Chuyển hướng về trang danh sách câu hỏi kèm theo thông báo thành công
        return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được thêm thành công');
    }

    // Phương thức hiển thị trang chỉnh sửa câu hỏi
    public function edit($id)
    {
        // Tìm câu hỏi theo ID
        $cauHoi = CauHoi::find($id);
        // Lấy danh sách tất cả môn học để chọn khi chỉnh sửa câu hỏi
        $monhocs = MonHoc::select('id', 'tenMonHoc')->get();

        // Nếu câu hỏi tồn tại, trả về view 'cauhoi.edit' kèm theo thông tin câu hỏi và danh sách môn học
        if ($cauHoi) {
            return view('cauhoi.edit', compact('cauHoi', 'monhocs'));
        }
        // Nếu không tồn tại, chuyển hướng về trang danh sách câu hỏi kèm theo thông báo lỗi
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    // Phương thức cập nhật thông tin câu hỏi
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'noiDung' => 'nullable|string', // Nội dung câu hỏi có thể trống và phải là chuỗi
            'typeAudio' => 'nullable|string|max:255', // Loại audio có thể trống và tối đa 255 ký tự
            'typeVideo' => 'nullable|string|max:255', // Loại video có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'doKho' => 'nullable|integer|min:1|max:5', // Độ khó của câu hỏi là số nguyên từ 1 đến 5
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học phải tồn tại trong bảng tb_MonHoc
        ]);

        // Tìm câu hỏi theo ID
        $cauHoi = CauHoi::find($id);
        // Nếu câu hỏi tồn tại, cập nhật thông tin câu hỏi với dữ liệu đã xác thực
        if ($cauHoi) {
            $cauHoi->update($request->all());
            // Chuyển hướng về trang danh sách câu hỏi kèm theo thông báo thành công
            return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được cập nhật thành công');
        }
        // Nếu không tồn tại, chuyển hướng về trang danh sách câu hỏi kèm theo thông báo lỗi
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    // Phương thức xóa câu hỏi
    public function destroy($id)
    {
        // Tìm câu hỏi theo ID
        $cauHoi = CauHoi::find($id);
        // Nếu câu hỏi tồn tại, xóa câu hỏi đó
        if ($cauHoi) {
            $cauHoi->delete();
            // Chuyển hướng về trang danh sách câu hỏi kèm theo thông báo thành công
            return redirect()->route('cauhoi.index')->with('success', 'Câu hỏi đã được xóa thành công');
        }
        // Nếu không tồn tại, chuyển hướng về trang danh sách câu hỏi kèm theo thông báo lỗi
        return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
    }

    // API JSON

    // Phương thức API để lấy danh sách câu hỏi
    public function apiIndex(Request $request)
    {
        // Tạo truy vấn để lấy danh sách câu hỏi
        $query = CauHoi::select('id', 'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id')
                       ->with('monhoc'); // Eager load mối quan hệ với môn học
    
        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($request->has('search')) {
            $search = $request->input('search'); // Lấy từ khóa tìm kiếm từ request
            $query->where('noiDung', 'LIKE', "%$search%") // Tìm kiếm theo nội dung câu hỏi
                  ->orWhereHas('monhoc', function ($query) use ($search) { // Tìm kiếm theo tên môn học
                      $query->where('tenMonHoc', 'LIKE', "%$search%");
                  });
        }
    
        // Nếu có tham số 'monhoc', lọc kết quả theo 'monhoc_id'
        if ($request->filled('monhoc')) {
            $monhoc_id = $request->input('monhoc');
            $query->where('monhoc_id', $monhoc_id);
        }
    
        // Nếu có tham số 'doKho', lọc kết quả theo 'doKho'
        if ($request->filled('doKho')) {
            $doKho = $request->input('doKho');
            $query->where('doKho', $doKho);
        }
    
        // Nếu có tham số 'limit', giới hạn số lượng câu hỏi trả về
        if ($request->filled('limit')) {
            $limit = (int) $request->input('limit');
            $query->limit($limit);
        }
    
        // Nếu có tham số 'random', sắp xếp ngẫu nhiên câu hỏi
        if ($request->has('random')) {
            $query->inRandomOrder();
        }
    
        // Thực hiện truy vấn và lấy kết quả
        $cauHois = $query->get();

        // nếu không có kết quả
        if ($cauHois->isEmpty()) {
            return response()->json(['message' => 'No results found'], 404);
        }
        
        // Trả về kết quả dưới dạng JSON với mã trạng thái 200
        return response()->json($cauHois, 200);
    }

    // Phương thức API để lấy chi tiết một câu hỏi cụ thể
    public function apiShow($id)
    {
        // Tìm câu hỏi theo ID và lấy kèm theo các đáp án (nếu có)
        $cauHoi = CauHoi::with('dapans')->find($id);
        // Nếu câu hỏi tồn tại, trả về kết quả dưới dạng JSON với mã trạng thái 200
        if ($cauHoi) {
            return response()->json($cauHoi, 200);
        }
        // Nếu không tồn tại, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Phương thức API để thêm câu hỏi mới
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'noiDung' => 'nullable|string', // Nội dung câu hỏi có thể trống và phải là chuỗi
            'typeAudio' => 'nullable|string|max:255', // Loại audio có thể trống và tối đa 255 ký tự
            'typeVideo' => 'nullable|string|max:255', // Loại video có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'doKho' => 'nullable|integer|min:1|max:5', // Độ khó của câu hỏi là số nguyên từ 1 đến 5
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học phải tồn tại trong bảng tb_MonHoc
        ]);

        // Tạo câu hỏi mới với dữ liệu đã xác thực và trả về kết quả dưới dạng JSON với mã trạng thái 201
        $cauHoi = CauHoi::create($request->all());
        return response()->json($cauHoi, 201);
    }

    // Phương thức API để cập nhật thông tin một câu hỏi
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'noiDung' => 'nullable|string', // Nội dung câu hỏi có thể trống và phải là chuỗi
            'typeAudio' => 'nullable|string|max:255', // Loại audio có thể trống và tối đa 255 ký tự
            'typeVideo' => 'nullable|string|max:255', // Loại video có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'doKho' => 'nullable|integer|min:1|max:5', // Độ khó của câu hỏi là số nguyên từ 1 đến 5
            'monhoc_id' => 'required|exists:tb_MonHoc,id', // ID môn học phải tồn tại trong bảng tb_MonHoc
        ]);

        // Tìm câu hỏi theo ID
        $cauHoi = CauHoi::find($id);
        // Nếu câu hỏi tồn tại, cập nhật thông tin câu hỏi với dữ liệu đã xác thực và trả về kết quả dưới dạng JSON với mã trạng thái 200
        if ($cauHoi) {
            $cauHoi->update($request->all());
            return response()->json($cauHoi, 200);
        }
        // Nếu không tồn tại, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Phương thức API để xóa một câu hỏi
    public function apiDestroy($id)
    {
        // Tìm câu hỏi theo ID
        $cauHoi = CauHoi::find($id);
        // Nếu câu hỏi tồn tại, xóa câu hỏi đó và trả về thông báo thành công với mã trạng thái 200
        if ($cauHoi) {
            $cauHoi->delete();
            return response()->json(['message' => 'Câu hỏi đã được xóa'], 200);
        }
        // Nếu không tồn tại, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }
}