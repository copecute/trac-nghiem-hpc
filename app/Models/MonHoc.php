<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;

    protected $table = 'tb_MonHoc';

    protected $fillable = [
        'maMonHoc', 'tenMonHoc', 'nganh_id',
    ];

    public function nganh()
    {
        return $this->belongsTo(Nganh::class, 'nganh_id');
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
