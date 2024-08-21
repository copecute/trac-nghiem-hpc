<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeThi extends Model
{
    use HasFactory;

    // Đặt tên bảng tương ứng với mô hình này trong cơ sở dữ liệu
    protected $table = 'tb_DeThi';

    // Các thuộc tính có thể được gán giá trị thông qua mass assignment
    protected $fillable = [
        'tenDe', 'soLuongCauHoi', 'tiLeKho', 'tiLeTrungBinh', 'tiLeDe', 'cauHoi', 'thoiGian', 'monhoc_id', 'cathi_id',
    ];

    // Các thuộc tính sẽ bị ẩn khi chuyển đổi thành mảng hoặc JSON
    protected $hidden = ['created_at', 'updated_at'];

    // Chuyển đổi thuộc tính cauHoi thành kiểu mảng khi truy xuất từ cơ sở dữ liệu
    protected $casts = [
        'cauHoi' => 'array',
    ];

    // Định nghĩa mối quan hệ nhiều-một với mô hình MonHoc
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }

    // Định nghĩa mối quan hệ nhiều-một với mô hình CaThi
    public function caThi()
    {
        return $this->belongsTo(CaThi::class, 'cathi_id');
    }
}