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
namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'admin')
    {
        // Lấy người dùng hiện tại từ hệ thống xác thực
        $user = Auth::user();

        if ($user) {
            // Nếu vai trò yêu cầu là 'admin'
            if ($role == 'admin') {
                // Nếu người dùng là admin, cho phép truy cập tất cả
                return $next($request);
            }
            
            // Nếu vai trò yêu cầu là 'user' và người dùng không có quyền (phanQuyen) 
            if ($role == 'user' && !$user->phanQuyen) {
                // Chuyển hướng người dùng về trang 'khoa.index' với thông báo lỗi
                return redirect()->route('khoa.index')->withErrors(['error' => 'Bạn không có quyền truy cập chức năng này']);
            }
        }

        // Nếu không có người dùng hoặc vai trò không khớp, tiếp tục xử lý yêu cầu
        return $next($request);
    }
}