<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CaThiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        
        foreach (range(1, 5) as $index) {
            DB::table('tb_CaThi')->insert([
                'tenCa' => 'Ca ' . $index,
                'thoiGianBatDau' => $faker->dateTimeBetween('now'),
                'thoiGianKetThuc' => $faker->dateTimeBetween('+1 weeks', '+2 weeks'),
                'kythi_id' => 1,
                'monhoc_id' => $faker->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
