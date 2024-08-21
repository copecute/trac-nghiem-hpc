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

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable; // Đảm bảo bạn kế thừa từ Authenticatable để sử dụng các chức năng liên quan đến xác thực
use Illuminate\Notifications\Notifiable; // Sử dụng trait Notifiable để hỗ trợ gửi thông báo

class SinhVien extends Authenticatable
{
    use HasApiTokens, Notifiable; // Sử dụng trait HasApiTokens để hỗ trợ xác thực API và Notifiable để gửi thông báo

    protected $table = 'tb_SinhVien'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với mô hình này

    protected $fillable = [
        'maSV', 'hoTen', 'ngaySinh', 'gioiTinh', 'diaChi', 'sdt', 'email', 'lop_id', 'matKhau',
    ]; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = [
        'matKhau', 'created_at', 'updated_at',
    ]; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON, chẳng hạn như mật khẩu và các timestamp

    // Định nghĩa mối quan hệ một-nhiều (belongsTo) với mô hình Lop
    public function lop()
    {
        return $this->belongsTo(Lop::class, 'lop_id'); // Một sinh viên thuộc về một lớp, dựa trên cột 'lop_id'
    }
}