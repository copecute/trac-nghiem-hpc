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
        Schema::create('tb_KyThi', function (Blueprint $table) {
            $table->id();                                // Tự động tăng id
            $table->string('tenKyThi');                  // Tên kỳ thi
            $table->date('ngayBatDau')->nullable();      // Ngày bắt đầu
            $table->date('ngayKetThuc')->nullable();     // Ngày kết thúc
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_KyThi');
    }
};
