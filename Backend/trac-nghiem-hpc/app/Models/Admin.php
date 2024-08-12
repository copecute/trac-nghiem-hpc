<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_Admin';

    protected $primaryKey = 'taiKhoan';

    protected $fillable = [
        'taiKhoan',
        'matKhau',
        'phanQuyen',
    ];

    protected $hidden = [
        'matKhau',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['matKhau'] = bcrypt($value);
    }
}
