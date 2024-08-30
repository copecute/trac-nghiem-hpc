<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KyThiSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');

        DB::table('tb_KyThi')->insert([
            [
                'tenKyThi' => 'Kỳ thi cuối kỳ 2024',
                'ngayBatDau' => $faker->dateTimeBetween('now', '+1 week'),
                'ngayKetThuc' => $faker->dateTimeBetween('+1 week', '+2 weeks'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
