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
        // Kiểm tra nếu người dùng đã đăng nhập
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user) {
            // Kiểm tra quyền truy cập nếu yêu cầu là 'admin'
            if ($role === 'admin') {
                if ($user->phanQuyen) {
                    return $next($request);
                } else {
                    return redirect()->route('dashboard')->withErrors(['error' => 'Admin access denied.']);
                }
            }

            // Kiểm tra quyền truy cập nếu yêu cầu là 'user'
            if ($role === 'user') {
                    return $next($request);
                }
        }

        return redirect()->route('dashboard')->withErrors(['error' => 'Access denied.']);
    }
}