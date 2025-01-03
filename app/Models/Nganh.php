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

class Nganh extends Model
{
    use HasFactory; // Sử dụng trait HasFactory để hỗ trợ việc tạo các đối tượng mô hình trong các factory

    protected $table = 'tb_Nganh'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với mô hình này

    protected $fillable = ['maNganh', 'tenNganh', 'khoa_id']; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = ['created_at', 'updated_at']; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON

    // Định nghĩa mối quan hệ một-nhiều (belongsTo) với mô hình Khoa
    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'khoa_id'); // Một ngành thuộc về một khoa, dựa trên cột 'khoa_id'
    }

    // Định nghĩa mối quan hệ một-nhiều (hasMany) với mô hình Lop
    public function lops()
    {
        return $this->hasMany(Lop::class, 'nganh_id'); // Một ngành có nhiều lớp, dựa trên cột 'nganh_id' trong bảng Lop
    }

    // Định nghĩa mối quan hệ một-nhiều (hasMany) với mô hình MonHoc
    public function monHocs()
    {
        return $this->hasMany(MonHoc::class, 'nganh_id'); // Một ngành có nhiều môn học, dựa trên cột 'nganh_id' trong bảng MonHoc
    }
}