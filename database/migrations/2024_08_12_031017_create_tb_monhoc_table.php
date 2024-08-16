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
        Schema::create('tb_MonHoc', function (Blueprint $table) {
            $table->id();                              // Tự động tăng id
            $table->string('maMonHoc')->unique();      // Mã môn học là duy nhất
            $table->string('tenMonHoc');
            $table->unsignedBigInteger('nghanh_id');    // Khóa ngoại tham chiếu đến bảng nghanh
            $table->timestamps();
        
            $table->foreign('nghanh_id')->references('id')->on('tb_Nghanh')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_MonHoc');
    }
};
