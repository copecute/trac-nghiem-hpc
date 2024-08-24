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
        Schema::create('tb_DeThi', function (Blueprint $table) {
            $table->id();
            $table->string('tenDe');
            $table->integer('soLuongCauHoi');
            $table->integer('tiLeKho');
            $table->integer('tiLeTrungBinh');
            $table->integer('tiLeDe');
            $table->json('cauHoi');
            $table->integer('thoiGian');
            $table->unsignedBigInteger('monhoc_id');
            $table->unsignedBigInteger('cathi_id');
            $table->timestamps();

            $table->foreign('monhoc_id')->references('id')->on('tb_MonHoc')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('cathi_id')->references('id')->on('tb_CaThi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_DeThi');
    }
};
