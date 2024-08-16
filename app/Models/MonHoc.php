<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;

    protected $table = 'tb_MonHoc';

    protected $fillable = [
        'maMonHoc', 'tenMonHoc', 'nghanh_id',
    ];

    public function nghanh()
    {
        return $this->belongsTo(Nghanh::class, 'nghanh_id');
    }

    public function cauHois()
    {
        return $this->hasMany(CauHoi::class, 'monhoc_id');
    }

    public function caThis()
    {
        return $this->hasMany(CaThi::class, 'monhoc_id');
    }
}
