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

class PhongThi extends Model
{
    use HasFactory; // Sử dụng trait HasFactory để hỗ trợ việc tạo các đối tượng mô hình trong các factory

    protected $table = 'tb_PhongThi'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với mô hình này

    protected $fillable = [
        'tenPhongThi', // Tên của phòng thi
        'danhSachSinhVien', // Danh sách sinh viên (thường là dạng mảng hoặc JSON)
        'cathi_id', // Khóa ngoại liên kết đến bảng tb_CaThi
    ]; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = ['created_at', 'updated_at']; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON

    // Định nghĩa mối quan hệ một-nhiều (belongsTo) với mô hình CaThi
    public function caThi()
    {
        return $this->belongsTo(CaThi::class, 'cathi_id'); // Một phòng thi thuộc về một ca thi, dựa trên cột 'cathi_id'
    }
}