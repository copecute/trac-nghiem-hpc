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
        Schema::create('tb_Nghanh', function (Blueprint $table) {
            $table->id();                              // Tự động tăng id
            $table->string('maNganh')->unique();       // Mã ngành là duy nhất
            $table->string('tenNganh');
            $table->unsignedBigInteger('khoa_id');     // Khóa ngoại tham chiếu đến bảng 'tb_khoa'
            $table->timestamps();
        
            $table->foreign('khoa_id')->references('id')->on('tb_Khoa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_Nghanh');
    }
};
