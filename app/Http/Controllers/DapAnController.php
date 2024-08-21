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
use App\Models\DapAn;
use App\Models\CauHoi;

class DapAnController extends Controller
{
    // Hiển thị danh sách các đáp án của một câu hỏi
    public function index($cauHoiId)
    {
        // Tìm câu hỏi dựa trên ID
        $cauHoi = CauHoi::find($cauHoiId);
        // Nếu không tìm thấy câu hỏi, chuyển hướng về trang danh sách câu hỏi với thông báo lỗi
        if (!$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
        }

        // Lấy tất cả các đáp án liên quan đến câu hỏi
        $dapAns = DapAn::where('cauhoi_id', $cauHoiId)->get();
        // Trả về view hiển thị danh sách đáp án với dữ liệu câu hỏi và đáp án
        return view('dapan.index', compact('cauHoi', 'dapAns'));
    }

    // Hiển thị form để thêm đáp án mới cho một câu hỏi
    public function create($cauHoiId)
    {
        // Tìm câu hỏi dựa trên ID
        $cauHoi = CauHoi::find($cauHoiId);
        // Nếu không tìm thấy câu hỏi, chuyển hướng về trang danh sách câu hỏi với thông báo lỗi
        if (!$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Câu hỏi không tồn tại');
        }

        // Trả về view tạo đáp án với dữ liệu câu hỏi
        return view('dapan.create', compact('cauHoi'));
    }

    // Lưu trữ đáp án mới vào cơ sở dữ liệu
    public function store(Request $request, $cauHoiId)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'typeText' => 'nullable|string|max:255',  // Loại văn bản có thể trống và tối đa 255 ký tự
            'typeAudio' => 'nullable|string|max:255', // Loại âm thanh có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'dapAnDung' => 'nullable|boolean',        // Đáp án đúng là giá trị boolean (true hoặc false)
        ]);

        // Tạo mới đáp án với dữ liệu đã xác thực và gắn với ID của câu hỏi
        DapAn::create([
            'typeText' => $request->input('typeText'),
            'typeAudio' => $request->input('typeAudio'),
            'typeImage' => $request->input('typeImage'),
            'dapAnDung' => $request->input('dapAnDung'),
            'cauhoi_id' => $cauHoiId,
        ]);

        // Chuyển hướng về trang danh sách đáp án của câu hỏi với thông báo thành công
        return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được thêm thành công');
    }

    // Hiển thị form để chỉnh sửa một đáp án
    public function edit($cauHoiId, $id)
    {
        // Tìm đáp án và câu hỏi dựa trên ID
        $dapAn = DapAn::find($id);
        $cauHoi = CauHoi::find($cauHoiId);

        // Nếu không tìm thấy đáp án hoặc câu hỏi, chuyển hướng về trang danh sách câu hỏi với thông báo lỗi
        if (!$dapAn || !$cauHoi) {
            return redirect()->route('cauhoi.index')->with('error', 'Không tìm thấy câu hỏi hoặc đáp án');
        }

        // Trả về view chỉnh sửa đáp án với dữ liệu đáp án và câu hỏi
        return view('dapan.edit', compact('dapAn', 'cauHoi'));
    }

    // Cập nhật thông tin một đáp án trong cơ sở dữ liệu
    public function update(Request $request, $cauHoiId, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'typeText' => 'nullable|string|max:255',  // Loại văn bản có thể trống và tối đa 255 ký tự
            'typeAudio' => 'nullable|string|max:255', // Loại âm thanh có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'dapAnDung' => 'nullable|boolean',        // Đáp án đúng là giá trị boolean (true hoặc false)
        ]);

        // Tìm đáp án dựa trên ID
        $dapAn = DapAn::find($id);
        // Nếu đáp án tồn tại, cập nhật với dữ liệu đã xác thực
        if ($dapAn) {
            $dapAn->update([
                'typeText' => $request->input('typeText'),
                'typeAudio' => $request->input('typeAudio'),
                'typeImage' => $request->input('typeImage'),
                'dapAnDung' => $request->input('dapAnDung'),
            ]);
            // Chuyển hướng về trang danh sách đáp án của câu hỏi với thông báo thành công
            return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được cập nhật thành công');
        }
        // Nếu đáp án không tồn tại, chuyển hướng về trang danh sách đáp án với thông báo lỗi
        return redirect()->route('dapan.index', $cauHoiId)->with('error', 'Đáp án không tồn tại');
    }

    // Xóa một đáp án khỏi cơ sở dữ liệu
    public function destroy($cauHoiId, $id)
    {
        // Tìm đáp án dựa trên ID
        $dapAn = DapAn::find($id);
        // Nếu đáp án tồn tại, xóa đáp án đó
        if ($dapAn) {
            $dapAn->delete();
            // Chuyển hướng về trang danh sách đáp án của câu hỏi với thông báo thành công
            return redirect()->route('dapan.index', $cauHoiId)->with('success', 'Đáp án đã được xóa thành công');
        }
        // Nếu đáp án không tồn tại, chuyển hướng về trang danh sách đáp án với thông báo lỗi
        return redirect()->route('dapan.index', $cauHoiId)->with('error', 'Đáp án không tồn tại');
    }

    // API JSON: Lấy danh sách tất cả đáp án của một câu hỏi
    public function apiIndex(Request $request, $cauHoiId)
    {
        // Lấy tất cả các đáp án liên quan đến câu hỏi
        $dapAns = DapAn::where('cauhoi_id', $cauHoiId)->get();
        // Trả về dữ liệu dưới dạng JSON với mã trạng thái 200
        return response()->json($dapAns, 200);
    }

    // API JSON: Lấy thông tin của một đáp án cụ thể theo ID
    public function apiShow($cauHoiId, $id)
    {
        // Tìm đáp án liên quan đến câu hỏi theo ID
        $dapAn = DapAn::where('cauhoi_id', $cauHoiId)->find($id);
        // Nếu đáp án tồn tại, trả về dữ liệu dưới dạng JSON với mã trạng thái 200
        if ($dapAn) {
            return response()->json($dapAn, 200);
        }
        // Nếu không tồn tại, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // API JSON: Lưu trữ đáp án mới vào cơ sở dữ liệu
    public function apiStore(Request $request, $cauHoiId)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'typeText' => 'nullable|string|max:255',  // Loại văn bản có thể trống và tối đa 255 ký tự
            'typeAudio' => 'nullable|string|max:255', // Loại âm thanh có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'dapAnDung' => 'nullable|boolean',        // Đáp án đúng là giá trị boolean (true hoặc false)
        ]);

        // Tạo mới đáp án với dữ liệu đã xác thực và gắn với ID của câu hỏi
        $dapAn = DapAn::create([
            'typeText' => $request->input('typeText'),
            'typeAudio' => $request->input('typeAudio'),
            'typeImage' => $request->input('typeImage'),
            'dapAnDung' => $request->input('dapAnDung'),
            'cauhoi_id' => $cauHoiId,
        ]);

        // Trả về dữ liệu đáp án mới tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($dapAn, 201);
    }

    // API JSON: Cập nhật thông tin một đáp án
    public function apiUpdate(Request $request, $cauHoiId, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'typeText' => 'nullable|string|max:255',  // Loại văn bản có thể trống và tối đa 255 ký tự
            'typeAudio' => 'nullable|string|max:255', // Loại âm thanh có thể trống và tối đa 255 ký tự
            'typeImage' => 'nullable|string|max:255', // Loại hình ảnh có thể trống và tối đa 255 ký tự
            'dapAnDung' => 'nullable|boolean',        // Đáp án đúng là giá trị boolean (true hoặc false)
        ]);

        // Tìm đáp án dựa trên ID
        $dapAn = DapAn::find($id);
        // Nếu đáp án tồn tại và thuộc về câu hỏi có ID tương ứng, cập nhật đáp án với dữ liệu đã xác thực
        if ($dapAn && $dapAn->cauhoi_id == $cauHoiId) {
            $dapAn->update([
                'typeText' => $request->input('typeText'),
                'typeAudio' => $request->input('typeAudio'),
                'typeImage' => $request->input('typeImage'),
                'dapAnDung' => $request->input('dapAnDung'),
            ]);
            // Trả về dữ liệu đáp án đã cập nhật dưới dạng JSON với mã trạng thái 200
            return response()->json($dapAn, 200);
        }
        // Nếu đáp án không tồn tại hoặc không thuộc về câu hỏi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // API JSON: Xóa một đáp án
    public function apiDestroy($cauHoiId, $id)
    {
        // Tìm đáp án dựa trên ID
        $dapAn = DapAn::find($id);
        // Nếu đáp án tồn tại và thuộc về câu hỏi có ID tương ứng, xóa đáp án đó
        if ($dapAn && $dapAn->cauhoi_id == $cauHoiId) {
            $dapAn->delete();
            // Trả về thông báo thành công dưới dạng JSON với mã trạng thái 200
            return response()->json(['message' => 'Đáp án đã được xóa'], 200);
        }
        // Nếu đáp án không tồn tại hoặc không thuộc về câu hỏi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }
}