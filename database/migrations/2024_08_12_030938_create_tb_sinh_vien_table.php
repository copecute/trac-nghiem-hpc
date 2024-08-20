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
        Schema::create('tb_SinhVien', function (Blueprint $table) {
            $table->id();                              // Tự động tăng id
            $table->string('maSV')->unique();          // Mã sinh viên là duy nhất
            $table->string('matKhau');
            $table->string('hoTen');
            $table->date('ngaySinh');
            $table->string('gioiTinh');
            $table->string('diaChi');
            $table->string('sdt');
            $table->string('email')->unique();         // Email là duy nhất
            $table->unsignedBigInteger('lop_id');      // Khóa ngoại tham chiếu đến bảng lop
            $table->timestamps();
        
            $table->foreign('lop_id')->references('id')->on('tb_Lop')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_SinhVien');
    }
};
