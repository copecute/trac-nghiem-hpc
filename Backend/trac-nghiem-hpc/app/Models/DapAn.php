<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DapAn extends Model
{
    use HasFactory;

    protected $table = 'tb_DapAn';

    protected $fillable = [
        'typeText', 'typeAudio', 'typeImage', 'dapAnDung', 'cauhoi_id',
    ];

    public function cauhoi()
    {
        return $this->belongsTo(CauHoi::class, 'cauhoi_id');
    }
}
