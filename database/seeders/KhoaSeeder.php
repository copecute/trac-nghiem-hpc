<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhoaSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_Khoa')->insert([
            ['maKhoa' => 'K1', 'tenKhoa' => 'Công nghệ thông tin', 'created_at' => now(), 'updated_at' => now()],
            ['maKhoa' => 'K2', 'tenKhoa' => 'Kinh tế', 'created_at' => now(), 'updated_at' => now()],
            ['maKhoa' => 'K3', 'tenKhoa' => 'Kỹ thuật', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
