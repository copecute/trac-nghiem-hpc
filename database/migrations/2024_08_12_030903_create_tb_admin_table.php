<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_Admin', function (Blueprint $table) {            
            $table->id(); // tự động tăng id
            $table->string('taiKhoan')->unique(); // tài khoản admin, duy nhất
            $table->string('matKhau'); // mật khẩu đã được mã hóa
            $table->tinyInteger('phanQuyen')->default(0); // 0=Nhân viên, 1=Admin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_Admin');
    }
};
