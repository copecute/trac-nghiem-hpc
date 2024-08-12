<?php

namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KyThi extends Model
{
    use HasFactory;

    protected $table = 'tb_KyThi';

    protected $fillable = [
        'tenKyThi', 'ngayBatDau', 'ngayKetThuc',
    ];
}
