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
        Schema::create('tb_KetQua', function (Blueprint $table) {
            $table->id();                                 // Tự động tăng id
            $table->decimal('diemSo', 5, 2)->nullable();  // Điểm số, kiểu decimal với 2 chữ số thập phân
            $table->json('danhSachDapAn')->nullable();    // Danh sách đáp án
            $table->unsignedBigInteger('dethi_id');       // Khóa ngoại tham chiếu đến bảng 'tb_dethi'
            $table->unsignedBigInteger('sinhvien_id');    // Khóa ngoại tham chiếu đến bảng 'tb_sinhvien'
            $table->timestamps();
        
            $table->foreign('dethi_id')->references('id')->on('tb_DeThi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('sinhvien_id')->references('id')->on('tb_SinhVien')->onUpdate('cascade')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_KetQua');
    }
};
