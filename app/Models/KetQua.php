<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KetQua extends Model
{
    use HasFactory;

    protected $table = 'tb_KetQua';

    protected $fillable = [
        'diemSo',
        'danhSachDapAn',
        'dethi_id',
        'sinhvien_id'
    ];

    protected $casts = [
        'danhSachDapAn' => 'array',
    ];

    // Define the relationship with DeThi
    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'dethi_id');
    }

    // Define the relationship with SinhVien
    public function sinhVien()
    {
        return $this->belongsTo(SinhVien::class, 'sinhvien_id');
    }
}
