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

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KyThi extends Model
{
    use HasFactory; // Sử dụng trait HasFactory để hỗ trợ việc tạo các đối tượng mô hình trong các factory

    protected $table = 'tb_KyThi'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với mô hình này

    protected $fillable = [
        'tenKyThi', 'ngayBatDau', 'ngayKetThuc',
    ]; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = ['created_at', 'updated_at']; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
}