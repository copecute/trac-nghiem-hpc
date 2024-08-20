<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable; // Đảm bảo bạn kế thừa từ Authenticatable
use Illuminate\Notifications\Notifiable;

class SinhVien extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'tb_SinhVien';

    protected $fillable = [
        'maSV', 'hoTen', 'ngaySinh', 'gioiTinh', 'diaChi', 'sdt', 'email', 'lop_id', 'matKhau',
    ];

    protected $hidden = [
        'matKhau',
    ];

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'lop_id');
    }
}