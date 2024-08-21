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
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_Admin';

    // Đặt khóa chính của bảng là 'taiKhoan'
    protected $primaryKey = 'taiKhoan';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'taiKhoan',
        'matKhau',
        'phanQuyen',
    ];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = [
        'matKhau', 'created_at', 'updated_at'
    ];

    // Hàm này sẽ được gọi khi thuộc tính 'matKhau' được gán giá trị
    public function setPasswordAttribute($value)
    {
        // Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
        $this->attributes['matKhau'] = bcrypt($value);
    }
}