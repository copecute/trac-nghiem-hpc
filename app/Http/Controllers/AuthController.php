<?php

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
        return view('auth.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('taiKhoan', 'matKhau');

        $admin = Admin::where('taiKhoan', $credentials['taiKhoan'])->first();

        if ($admin && Hash::check($credentials['matKhau'], $admin->matKhau)) {
            Auth::login($admin);
            return redirect()->route('khoa.index')->with('success', 'Đăng nhập thành công');
        }

        return redirect()->back()->withErrors(['error' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

    // Hiển thị form đăng ký
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $request->validate([
            'taiKhoan' => 'required|unique:tb_Admin,taiKhoan',
            'matKhau' => 'required|min:6',
        ], [
            'taiKhoan.required' => 'Tên đăng nhập là bắt buộc',
            'taiKhoan.unique' => 'Tên đăng nhập đã tồn tại',
            'matKhau.required' => 'Mật khẩu là bắt buộc',
            'matKhau.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);

        $admin = new Admin();
        $admin->taiKhoan = $request->taiKhoan;
        $admin->matKhau = Hash::make($request->matKhau); // Mã hóa mật khẩu
        $admin->phanQuyen = $request->phanQuyen ?? false;
        $admin->save();

        return redirect()->route('login')->with('success', 'Đăng ký thành công. Bạn có thể đăng nhập.');
    }

    // Xử lý đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Bạn đã đăng xuất thành công');
    }
}
