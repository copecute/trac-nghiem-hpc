<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Gọi tất cả các seeder
        $this->call([
            AdminSeeder::class,
            KhoaSeeder::class,
            NganhSeeder::class,
            LopSeeder::class,
            SinhVienSeeder::class,
            MonHocSeeder::class,
            KyThiSeeder::class,
            CaThiSeeder::class,
            PhongThiSeeder::class,
            DeThiSeeder::class,
            CauHoiDapAnSeeder::class,
            KetQuaSeeder::class,
        ]);
    }
}