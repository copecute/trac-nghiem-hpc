<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetQuaSeeder extends Seeder
{
    public function run()
    {
        DB::table('tb_KetQua')->insert([
            [
                'diemSo' => 8.5,
                'danhSachDapAn' => json_encode([1 => true, 2 => false, 3 => true]),
                'dethi_id' => 1,
                'sinhvien_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
