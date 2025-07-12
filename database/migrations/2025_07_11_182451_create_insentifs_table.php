<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('insentifs', function (Blueprint $table) {
        $table->id();         
        $table->string('nama');               
        $table->integer('jumlah_lembur');   
        $table->integer('jumlah_absen');      
        $table->integer('insentif');      
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insentifs');
    }
};
