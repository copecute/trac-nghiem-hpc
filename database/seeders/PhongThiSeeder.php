<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class PhongThiSeeder extends Seeder
{
    public function run()
    {
        // lấy msv
        $maSVs = DB::table('tb_SinhVien')->pluck('maSV')->toArray();
        
        // random 10 maSV
        $selectedMaSVs = array_rand(array_flip($maSVs), 10);

        DB::table('tb_PhongThi')->insert([
            [
                'tenPhongThi' => 'Phòng A1',
                'danhSachSinhVien' => json_encode($selectedMaSVs),
                'cathi_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
