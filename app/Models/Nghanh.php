<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nghanh extends Model
{
    use HasFactory;
    
    protected $table = 'tb_Nghanh';

    protected $fillable = ['maNghanh', 'tenNghanh', 'khoa_id'];

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
        return $this->hasMany(MonHoc::class, 'nghanh_id');
    }
}
