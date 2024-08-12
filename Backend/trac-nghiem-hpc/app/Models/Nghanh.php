<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nghanh extends Model
{
    protected $table = 'tb_Nghanh';

    protected $fillable = ['maNghanh', 'tenNghanh', 'khoa_id'];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }
}
