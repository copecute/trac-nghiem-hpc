<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaThi extends Model
{
    use HasFactory;

    protected $table = 'tb_CaThi';

    protected $fillable = [
        'tenCa', 'thoiGianBatDau', 'thoiGianKetThuc', 'kythi_id', 'monhoc_id',
    ];

    public function kyThi()
    {
        return $this->belongsTo(KyThi::class, 'kythi_id');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }
    public function phongThis()
    {
        return $this->hasMany(PhongThi::class, 'cathi_id');
    }
}
