<?php

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
        $user = Auth::user();

        if ($user) {
            if ($role == 'admin') {
                // Nếu người dùng là admin, cho phép truy cập tất cả
                return $next($request);
            }
            
            if ($role == 'user' && !$user->phanQuyen) {
                // Nếu người dùng không phải admin và yêu cầu quyền user
                return redirect()->route('khoa.index')->withErrors(['error' => 'Bạn không có quyền truy cập chức năng này']);
            }
        }

        return $next($request);
    }
}
