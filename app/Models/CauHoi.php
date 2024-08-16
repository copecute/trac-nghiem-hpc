<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    use HasFactory;

    protected $table = 'tb_CauHoi';

    protected $fillable = [
        'noiDung', 'typeAudio', 'typeVideo', 'typeImage', 'doKho', 'monhoc_id',
    ];

    public function dapAns()
    {
        return $this->hasMany(DapAn::class, 'cauhoi_id');
    }

    public function monhoc()
    {
        return $this->belongsTo(MonHoc::class, 'monhoc_id');
    }
}
