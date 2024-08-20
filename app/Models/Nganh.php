<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nganh extends Model
{
    use HasFactory;
    
    protected $table = 'tb_Nganh';

    protected $fillable = ['maNganh', 'tenNganh', 'khoa_id'];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }

    public function lops()
    {
        return $this->hasMany(Lop::class);
    }

    public function monHocs()
    {
        return $this->hasMany(MonHoc::class, 'nganh_id');
    }
}
