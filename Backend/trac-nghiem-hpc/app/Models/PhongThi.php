<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhongThi extends Model
{
    use HasFactory;

    protected $table = 'tb_PhongThi';

    protected $fillable = [
        'tenPhongThi',
        'danhSachSinhVien',
        'cathi_id',
    ];

    // Thiết lập mối quan hệ với bảng tb_CaThi
    public function caThi()
    {
        return $this->belongsTo(CaThi::class, 'cathi_id');
    }
}
