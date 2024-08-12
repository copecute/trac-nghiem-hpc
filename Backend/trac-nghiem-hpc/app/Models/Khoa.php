<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    protected $table = 'tb_Khoa';

    protected $fillable = [
        'maKhoa',
        'tenKhoa'
    ];
}
