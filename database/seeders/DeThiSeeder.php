<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeThiSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_DeThi')->insert([
            [
                'tenDe' => 'Đề thi PHP cơ bản',
                'soLuongCauHoi' => 10,
                'tiLeKho' => 20,
                'tiLeTrungBinh' => 50,
                'tiLeDe' => 30,
                'cauHoi' => json_encode([1, 2, 3, 4, 5]),
                'thoiGian' => 90,
                'monhoc_id' => 1,
                'cathi_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
