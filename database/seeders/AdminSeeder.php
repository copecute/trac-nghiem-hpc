<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Kiểm tra nếu tài khoản 'admin' đã tồn tại
        $existingAdmin = DB::table('tb_Admin')->where('taiKhoan', 'admin')->first();

        if (!$existingAdmin) {
            DB::table('tb_Admin')->insert([
                'taiKhoan' => 'admin',
                'matKhau' => Hash::make('123456'), // Mã hóa mật khẩu
                'phanQuyen' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
