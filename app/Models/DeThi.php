<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeThi extends Model
{
    use HasFactory;

    protected $table = 'tb_DeThi';

    protected $fillable = [
        'tenDe', 'soLuongCauHoi', 'tiLeKho', 'tiLeTrungBinh', 'tiLeDe', 'cauHoi', 'thoiGian', 'monhoc_id', 'cathi_id',
    ];

    protected $casts = [
        'cauHoi' => 'array',  // Để làm việc với dữ liệu JSON
    ];

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }

    public function caThi()
    {
        return $this->belongsTo(CaThi::class, 'cathi_id');
    }
}
