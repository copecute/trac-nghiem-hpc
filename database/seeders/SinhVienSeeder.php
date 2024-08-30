<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SinhVienSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('vi_VN');
        
        // Lấy tất cả các `lop_id` hợp lệ từ `tb_Lop`
        $lopIds = DB::table('tb_Lop')->pluck('id')->toArray();
        
        foreach (range(1, 50) as $index) {
            // Chọn một `lop_id` ngẫu nhiên từ danh sách hợp lệ, hoặc sử dụng một giá trị mặc định nếu không hợp lệ
            $lop_id = $faker->randomElement($lopIds);
            
            // Nếu không có `lop_id` hợp lệ, bỏ qua việc chèn bản ghi này
            if (is_null($lop_id)) {
                continue;
            }

            DB::table('tb_SinhVien')->insert([
                'maSV' => 'SV' . $faker->unique()->numerify('###'),
                'matKhau' => Hash::make('123456'),
                'hoTen' => $faker->name,
                'ngaySinh' => $faker->date(),
                'gioiTinh' => $faker->randomElement(['Nam', 'Nữ']),
                'diaChi' => $faker->address,
                'sdt' => $faker->phoneNumber,
                'email' => $faker->unique()->email,
                'lop_id' => $lop_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
