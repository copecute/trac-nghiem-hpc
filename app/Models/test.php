<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class test extends Model
{
    use HasFactory; // Sử dụng trait HasFactory để hỗ trợ việc tạo các đối tượng model trong các factory

    protected $table = 'tb_Khoa'; // Đặt tên bảng trong cơ sở dữ liệu tương ứng với model này

    protected $fillable = [
        'maKhoa',
        'tenKhoa'
    ]; // Các thuộc tính có thể được gán giá trị thông qua mass assignment

    protected $hidden = ['created_at', 'updated_at']; // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
}
?>
