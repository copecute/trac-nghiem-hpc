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
        Schema::create('tb_PhongThi', function (Blueprint $table) {
            $table->id();                                  // Tự động tăng id
            $table->string('tenPhongThi')->nullable();     // Tên phòng thi
            $table->json('danhSachSinhVien')->nullable();  // Danh sách sinh viên
            $table->unsignedBigInteger('cathi_id');        // Khóa ngoại tham chiếu đến bảng ca thi
            $table->timestamps();
        
            $table->foreign('cathi_id')->references('id')->on('tb_CaThi')->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_PhongThi');
    }
};
