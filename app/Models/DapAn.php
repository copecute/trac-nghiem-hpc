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

class DapAn extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_DapAn';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'typeText', 'typeAudio', 'typeImage', 'dapAnDung', 'cauhoi_id',
    ];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = ['created_at', 'updated_at'];

    // Định nghĩa mối quan hệ nhiều-một với mô hình CauHoi
    public function cauhoi()
    {
        // DapAn thuộc về một CauHoi
        return $this->belongsTo(CauHoi::class, 'cauhoi_id');
    }
}