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
            $table->id();                              // Tự động tăng id
            $table->string('taiKhoan')->unique();
            $table->string('matKhau');
            $table->tinyInteger('phanQuyen')->default(0); // đã thử boolean không hoạt động tốt
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
