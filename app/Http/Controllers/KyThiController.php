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
use App\Models\KyThi;

class KyThiController extends Controller
{
    // Views

    // Hiển thị danh sách tất cả các kỳ thi
    public function index()
    {
        // Lấy tất cả các kỳ thi với các trường 'id', 'tenKyThi', 'ngayBatDau', và 'ngayKetThuc'
        $kyThis = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc')->get();
        
        // Trả về view 'kythi.index' và truyền dữ liệu kỳ thi vào view
        return view('kythi.index', compact('kyThis'));
    }

    // Tìm kiếm kỳ thi theo từ khóa
    public function search(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'tenKyThi', 'ngayBatDau', và 'ngayKetThuc'
        $query = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tenKyThi', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $kyThis = $query->get();
        
        // Trả về view 'kythi.index' và truyền dữ liệu kỳ thi vào view
        return view('kythi.index', compact('kyThis'));
    }

    // Hiển thị form để tạo mới kỳ thi
    public function create()
    {
        // Trả về view 'kythi.create'
        return view('kythi.create');
    }

    // Lưu thông tin kỳ thi mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255', // 'tenKyThi' không bắt buộc, có thể là chuỗi, tối đa 255 ký tự
            'ngayBatDau' => 'nullable|date',         // 'ngayBatDau' không bắt buộc, phải là định dạng ngày tháng
            'ngayKetThuc' => 'nullable|date',        // 'ngayKetThuc' không bắt buộc, phải là định dạng ngày tháng
        ]);

        // Tạo mới kỳ thi với dữ liệu từ request
        KyThi::create($request->all());

        // Chuyển hướng đến trang danh sách kỳ thi và thông báo thành công
        return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được thêm thành công');
    }

    // Hiển thị form để chỉnh sửa thông tin kỳ thi
    public function edit($id)
    {
        // Tìm kỳ thi theo ID
        $kyThi = KyThi::find($id);

        // Nếu tìm thấy kỳ thi, trả về view 'kythi.edit' với dữ liệu kỳ thi
        if ($kyThi) {
            return view('kythi.edit', compact('kyThi'));
        }

        // Nếu không tìm thấy kỳ thi, chuyển hướng đến trang danh sách kỳ thi và thông báo lỗi
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    // Cập nhật thông tin kỳ thi
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255', // 'tenKyThi' không bắt buộc, có thể là chuỗi, tối đa 255 ký tự
            'ngayBatDau' => 'nullable|date',         // 'ngayBatDau' không bắt buộc, phải là định dạng ngày tháng
            'ngayKetThuc' => 'nullable|date',        // 'ngayKetThuc' không bắt buộc, phải là định dạng ngày tháng
        ]);

        // Tìm kỳ thi theo ID
        $kyThi = KyThi::find($id);
        
        // Nếu tìm thấy kỳ thi, cập nhật thông tin và chuyển hướng đến trang danh sách kỳ thi với thông báo thành công
        if ($kyThi) {
            $kyThi->update($request->all());
            return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được cập nhật thành công');
        }

        // Nếu không tìm thấy kỳ thi, chuyển hướng đến trang danh sách kỳ thi và thông báo lỗi
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    // Xóa kỳ thi
    public function destroy($id)
    {
        // Tìm kỳ thi theo ID
        $kyThi = KyThi::find($id);
        
        // Nếu tìm thấy kỳ thi, xóa và chuyển hướng đến trang danh sách kỳ thi với thông báo thành công
        if ($kyThi) {
            $kyThi->delete();
            return redirect()->route('kythi.index')->with('success', 'Kỳ thi đã được xóa thành công');
        }

        // Nếu không tìm thấy kỳ thi, chuyển hướng đến trang danh sách kỳ thi và thông báo lỗi
        return redirect()->route('kythi.index')->with('error', 'Kỳ thi không tồn tại');
    }

    // API JSON

    // Lấy danh sách kỳ thi dưới dạng JSON với khả năng tìm kiếm
    public function apiIndex(Request $request)
    {
        // Khởi tạo query để chọn các trường 'id', 'tenKyThi', 'ngayBatDau', và 'ngayKetThuc'
        $query = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc');

        // Nếu có từ khóa tìm kiếm, thêm điều kiện vào query
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('tenKyThi', 'LIKE', "%$search%");
        }

        // Thực hiện truy vấn và lấy kết quả
        $kyThis = $query->get();
        
        // Trả về dữ liệu kỳ thi dưới dạng JSON với mã trạng thái 200
        return response()->json($kyThis, 200);
    }

    // Lấy thông tin kỳ thi theo ID dưới dạng JSON
    public function apiShow($id)
    {
        // Tìm kỳ thi theo ID và chọn các trường 'id', 'tenKyThi', 'ngayBatDau', và 'ngayKetThuc'
        $kyThi = KyThi::select('id', 'tenKyThi', 'ngayBatDau', 'ngayKetThuc')->find($id);
        
        // Nếu tìm thấy kỳ thi, trả về dữ liệu kỳ thi dưới dạng JSON với mã trạng thái 200
        if ($kyThi) {
            return response()->json($kyThi, 200);
        }

        // Nếu không tìm thấy kỳ thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Tạo mới kỳ thi và trả về dữ liệu dưới dạng JSON
    public function apiStore(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255', // 'tenKyThi' không bắt buộc, có thể là chuỗi, tối đa 255 ký tự
            'ngayBatDau' => 'nullable|date',         // 'ngayBatDau' không bắt buộc, phải là định dạng ngày tháng
            'ngayKetThuc' => 'nullable|date',        // 'ngayKetThuc' không bắt buộc, phải là định dạng ngày tháng
        ]);

        // Tạo mới kỳ thi với dữ liệu từ request
        $kyThi = KyThi::create($request->all());
        
        // Trả về dữ liệu kỳ thi mới được tạo dưới dạng JSON với mã trạng thái 201
        return response()->json($kyThi, 201);
    }

    // Cập nhật thông tin kỳ thi và trả về dữ liệu dưới dạng JSON
    public function apiUpdate(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'tenKyThi' => 'nullable|string|max:255', // 'tenKyThi' không bắt buộc, có thể là chuỗi, tối đa 255 ký tự
            'ngayBatDau' => 'nullable|date',         // 'ngayBatDau' không bắt buộc, phải là định dạng ngày tháng
            'ngayKetThuc' => 'nullable|date',        // 'ngayKetThuc' không bắt buộc, phải là định dạng ngày tháng
        ]);

        // Tìm kỳ thi theo ID
        $kyThi = KyThi::find($id);
        
        // Nếu tìm thấy kỳ thi, cập nhật thông tin và trả về dữ liệu cập nhật dưới dạng JSON với mã trạng thái 200
        if ($kyThi) {
            $kyThi->update($request->all());
            return response()->json($kyThi, 200);
        }

        // Nếu không tìm thấy kỳ thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }

    // Xóa kỳ thi và trả về thông báo dưới dạng JSON
    public function apiDestroy($id)
    {
        // Tìm kỳ thi theo ID
        $kyThi = KyThi::find($id);
        
        // Nếu tìm thấy kỳ thi, xóa và trả về thông báo dưới dạng JSON với mã trạng thái 200
        if ($kyThi) {
            $kyThi->delete();
            return response()->json(['message' => 'Kỳ thi đã được xóa'], 200);
        }

        // Nếu không tìm thấy kỳ thi, trả về thông báo lỗi với mã trạng thái 404
        return response()->json(['message' => 'Not found'], 404);
    }
}