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
        Schema::create('tb_Lop', function (Blueprint $table) {
            $table->id();                              // Tự động tăng id
            $table->string('maLop')->unique();         // Mã lớp là duy nhất
            $table->string('tenLop');
            $table->unsignedBigInteger('nganh_id');     // Khóa ngoại tham chiếu đến bảng nghành
            $table->timestamps();
        
            $table->foreign('nganh_id')->references('id')->on('tb_Nganh')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_Lop');
    }
};
