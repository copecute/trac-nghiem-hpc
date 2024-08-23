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
            $table->id()->comment('Tự động tăng id');
            $table->string('taiKhoan')->unique()->comment('Tài khoản admin, duy nhất');
            $table->string('matKhau')->comment('Mật khẩu đã được mã hóa');
            $table->tinyInteger('phanQuyen')->default(0)->comment(' 0=Nhân viên, 1=Admin');
            $table->timestamps()->comment('Thời gian tạo và cập nhật');
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
