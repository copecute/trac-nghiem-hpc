<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_CaThi', function (Blueprint $table) {
            $table->id();                                // Tự động tăng id
            $table->string('tenCa');                     // Tên ca thi
            $table->dateTime('thoiGianBatDau');          // Thời gian bắt đầu
            $table->dateTime('thoiGianKetThuc');         // Thời gian kết thúc
            $table->unsignedBigInteger('kythi_id');      // Khóa ngoại tham chiếu đến bảng 'tb_kithi'
            $table->unsignedBigInteger('monhoc_id');     // Khóa ngoại tham chiếu đến bảng 'tb_monhoc'
            $table->timestamps();

            $table->foreign('kythi_id')->references('id')->on('tb_KyThi')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('monhoc_id')->references('id')->on('tb_MonHoc')->onUpdate('cascade')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_CaThi');
    }
};
