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
use Illuminate\Support\Carbon;

class CaThi extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_CaThi';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'tenCa', 'thoiGianBatDau', 'thoiGianKetThuc', 'kythi_id', 'monhoc_id',
    ];

    protected $dates = ['thoiGianBatDau', 'thoiGianKetThuc'];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = ['created_at', 'updated_at'];
    
    // Định nghĩa mối quan hệ một-nhiều với mô hình KyThi
    public function kyThi()
    {
        // CaThi thuộc về một KyThi
        return $this->belongsTo(KyThi::class, 'kythi_id');
    }

    // Định nghĩa mối quan hệ một-nhiều với mô hình MonHoc
    public function monHoc()
    {
        // CaThi thuộc về một MonHoc
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }

    // Định nghĩa mối quan hệ một-nhiều với mô hình PhongThi
    public function phongThis()
    {
        // CaThi có nhiều PhongThi
        return $this->hasMany(PhongThi::class, 'cathi_id');
    }
}