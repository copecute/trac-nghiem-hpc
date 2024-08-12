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
        Schema::create('tb_DapAn', function (Blueprint $table) {
            $table->id();                                
            $table->string('typeText')->nullable();
            $table->string('typeAudio')->nullable();
            $table->string('typeImage')->nullable();
            $table->boolean('dapAnDung');                
            $table->unsignedBigInteger('cauhoi_id');     
            $table->timestamps();
        
            $table->foreign('cauhoi_id')->references('id')->on('tb_CauHoi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_DapAn');
    }
};
