<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonHocSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_MonHoc')->insert([
            ['maMonHoc' => 'PHP101', 'tenMonHoc' => 'Lập trình PHP', 'nganh_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['maMonHoc' => 'DB101', 'tenMonHoc' => 'Cơ sở dữ liệu', 'nganh_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['maMonHoc' => 'BUS101', 'tenMonHoc' => 'Quản trị kinh doanh', 'nganh_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
