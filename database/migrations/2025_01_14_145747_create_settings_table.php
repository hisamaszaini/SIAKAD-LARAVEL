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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_nama')->nullable();
            $table->string('app_namapendek')->nullable();
            $table->string('pagination')->nullable();
            $table->string('lembaga_nama')->nullable();
            $table->string('lembaga_jalan')->nullable();
            $table->string('lembaga_telp')->nullable();
            $table->string('lembaga_kota')->nullable();
            $table->string('lembaga_logo')->nullable();
            $table->string('sekolah_logo')->nullable();
            $table->string('nama_kepsek')->nullable();
            $table->string('nominaltagihan')->nullable();
            $table->string('semesteraktif')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
