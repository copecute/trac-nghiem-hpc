<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_KetQua';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'diemSo',
        'danhSachDapAn',
        'dethi_id',
        'sinhvien_id'
    ];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = ['created_at', 'updated_at'];
    
    // Chuyển đổi thuộc tính danhSachDapAn thành kiểu mảng khi truy xuất từ cơ sở dữ liệu
    protected $casts = [
        'danhSachDapAn' => 'array',
    ];

    // Định nghĩa mối quan hệ nhiều-một với mô hình DeThi
    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'dethi_id');
    }

    // Định nghĩa mối quan hệ nhiều-một với mô hình SinhVien
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'sinhvien_id');
    }
}
