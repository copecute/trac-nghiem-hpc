<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CauHoiDapAnSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        
        foreach (range(1, 20) as $index) {
            
            $cauHoiId = DB::table('tb_CauHoi')->insertGetId([
                'noiDung' => $faker->sentence,
                'typeAudio' => null,
                'typeVideo' => null,
                'typeImage' => null,
                'doKho' => $faker->numberBetween(1, 5),
                'monhoc_id' => $faker->numberBetween(1, 3),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $dapAnDungId = null;

            foreach (range(1, 4) as $index) {
                $dapAnId = DB::table('tb_DapAn')->insertGetId([
                    'typeText' => $faker->sentence,
                    'typeAudio' => null,
                    'typeImage' => null,
                    'dapAnDung' => $index === 1, // Chỉ có một đáp án đúng, chọn đáp án đầu tiên là đúng
                    'cauhoi_id' => $cauHoiId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                if ($index === 1) {
                    $dapAnDungId = $dapAnId;
                }
            }
        }
    }
}
