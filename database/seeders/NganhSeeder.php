<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NganhSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_Nganh')->insert([
            ['maNganh' => 'CNTT', 'tenNganh' => 'Công nghệ thông tin', 'khoa_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['maNganh' => 'KD', 'tenNganh' => 'Kinh doanh', 'khoa_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
