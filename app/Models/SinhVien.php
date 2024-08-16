<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    use HasFactory;

    protected $table = 'tb_SinhVien';

    protected $fillable = [
        'maSV', 'hoTen', 'ngaySinh', 'gioiTinh', 'diaChi', 'sdt', 'email', 'lop_id',
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'lop_id');
    }
}
