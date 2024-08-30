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
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login'); // Trả về view cho form đăng nhập
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Lấy thông tin đăng nhập từ request, chỉ lấy 'taiKhoan' và 'matKhau'
        $credentials = $request->only('taiKhoan', 'matKhau');

        // Tìm admin dựa trên tài khoản (taiKhoan)
        $admin = Admin::where('taiKhoan', $credentials['taiKhoan'])->first();

        // Kiểm tra nếu tồn tại admin và mật khẩu (matKhau) khớp với mật khẩu được mã hóa trong cơ sở dữ liệu
        if ($admin && Hash::check($credentials['matKhau'], $admin->matKhau)) {
            // Đăng nhập admin
            Auth::login($admin);
            // Chuyển hướng tới trang danh sách Khoa với thông báo thành công
            return redirect()->route('dashboard')->with('success', 'Đăng nhập thành công');
        }

        // Nếu thông tin đăng nhập không đúng, quay lại trang trước và hiển thị lỗi
        return redirect()->back()->withErrors(['error' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register'); // Trả về view cho form đăng ký
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        // Kiểm tra tính hợp lệ của dữ liệu
        $request->validate([
            'taiKhoan' => 'required|unique:tb_Admin,taiKhoan', // Tài khoản là bắt buộc và phải duy nhất trong bảng tb_Admin
            'matKhau' => 'required|min:6', // Mật khẩu là bắt buộc và phải có ít nhất 6 ký tự
        ], [
            // Thông báo lỗi khi không hợp lệ
            'taiKhoan.required' => 'Tên đăng nhập là bắt buộc',
            'taiKhoan.unique' => 'Tên đăng nhập đã tồn tại',
            'matKhau.required' => 'Mật khẩu là bắt buộc',
            'matKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        // Tạo mới một đối tượng Admin
        $admin = new Admin();
        $admin->taiKhoan = $request->taiKhoan; // Gán giá trị cho thuộc tính tài khoản (taiKhoan)
        $admin->matKhau = Hash::make($request->matKhau); // Mã hóa mật khẩu trước khi lưu
        $admin->phanQuyen = $request->phanQuyen ?? false; // Gán giá trị quyền, mặc định là false nếu không có giá trị từ request
        $admin->save(); // Lưu admin mới vào cơ sở dữ liệu

        // Chuyển hướng tới trang đăng nhập với thông báo thành công
        return redirect()->route('login')->with('success', 'Đăng ký thành công. Bạn có thể đăng nhập.');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout(); // Thực hiện việc đăng xuất
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công'); // Chuyển hướng tới trang đăng nhập với thông báo thành công
    }
}