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

class CauHoi extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_CauHoi';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id',
    ];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = ['created_at', 'updated_at'];
    
    // Định nghĩa mối quan hệ một-nhiều với mô hình DapAn
    public function dapAns()
    {
        // CauHoi có nhiều DapAn
        return $this->hasMany(DapAn::class, 'cauhoi_id');
    }

    // Định nghĩa mối quan hệ nhiều-một với mô hình MonHoc
    public function monhoc()
    {
        // CauHoi thuộc về một MonHoc
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }
}