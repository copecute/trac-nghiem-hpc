<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LopSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_Lop')->insert([
            ['maLop' => 'CNTT01', 'tenLop' => 'Lớp CNTT 01', 'nganh_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['maLop' => 'CNTT02', 'tenLop' => 'Lớp CNTT 02', 'nganh_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['maLop' => 'KD01', 'tenLop' => 'Lớp Kinh doanh 01', 'nganh_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
