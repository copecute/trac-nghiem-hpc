<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;

    protected $table = 'tb_Lop';
    protected $fillable = ['maLop', 'tenLop', 'nghanh_id'];

    public function nghanh()
    {
        return $this->belongsTo(Nghanh::class);
    }

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'lop_id');
    }
}
