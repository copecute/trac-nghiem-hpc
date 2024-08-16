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
        Schema::create('tb_CauHoi', function (Blueprint $table) {
            $table->id();                              
            $table->text('noiDung')->nullable();       
            $table->string('typeAudio')->nullable();
            $table->string('typeVideo')->nullable();
            $table->string('typeImage')->nullable();
            $table->tinyInteger('doKho')->nullable();  
            $table->unsignedBigInteger('monhoc_id');   
            $table->timestamps();
        
            $table->foreign('monhoc_id')->references('id')->on('tb_MonHoc')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_CauHoi');
    }
};
