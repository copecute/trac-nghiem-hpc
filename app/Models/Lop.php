<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    use HasFactory;

    protected $table = 'tb_Lop';
    protected $fillable = ['maLop', 'tenLop', 'nganh_id'];

    public function nganh()
    {
        return $this->belongsTo(Nganh::class);
    }

    public function sinhViens()
    {
        return $this->hasMany(SinhVien::class, 'lop_id');
    }
}
