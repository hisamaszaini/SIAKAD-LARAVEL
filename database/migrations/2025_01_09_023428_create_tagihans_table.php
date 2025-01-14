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
        Schema::create('tagihan', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 30);
            $table->integer('nominal');
            $table->string('keterangan', 50)->nullable();
            $table->tinyInteger('tingkatan');
            $table->tinyInteger('semester');
            $table->date('tgl_tagihan');
            $table->date('tgl_tempo');
            $table->timestamps();
        });
    }    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihan');
    }
};
