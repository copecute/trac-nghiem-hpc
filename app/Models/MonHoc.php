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

class MonHoc extends Model
{
    use HasFactory; // Sử dụng trait HasFactory để hỗ trợ việc tạo các đối tượng mô hình trong các factory

    protected $table = 'tb_MonHoc'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với mô hình này

    protected $fillable = [
        'maMonHoc', 'tenMonHoc', 'nganh_id',
    ]; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = ['created_at', 'updated_at']; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON

    // Định nghĩa mối quan hệ một-nhiều (belongsTo) với mô hình Nganh
    public function nganh()
    {
        return $this->belongsTo(Nganh::class, 'nganh_id'); // Một môn học thuộc về một ngành, dựa trên cột 'nganh_id'
    }

    // Định nghĩa mối quan hệ một-nhiều (hasMany) với mô hình CauHoi
    public function cauHois()
    {
        return $this->hasMany(CauHoi::class, 'monhoc_id'); // Một môn học có nhiều câu hỏi, dựa trên cột 'monhoc_id' trong bảng CauHoi
    }

    // Định nghĩa mối quan hệ một-nhiều (hasMany) với mô hình CaThi
    public function caThis()
    {
        return $this->hasMany(CaThi::class, 'monhoc_id'); // Một môn học có nhiều ca thi, dựa trên cột 'monhoc_id' trong bảng CaThi
    }
}