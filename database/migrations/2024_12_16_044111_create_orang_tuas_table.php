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
        Schema::create('orang_tua', function (Blueprint $table) {
            $table->id();
            $table->foreignId('siswa_id')->constrained('siswa')->onDelete('cascade');
            $table->string('nama_ayah', 50)->nullable();
            $table->string('telp_ayah', 15)->nullable();
            $table->string('pekerjaan_ayah', 50)->nullable();
            $table->decimal('penghasilan_ayah', 15, 2)->nullable();
            $table->string('nama_ibu', 50)->nullable();
            $table->string('telp_ibu', 15)->nullable();
            $table->string('pekerjaan_ibu', 50)->nullable();
            $table->decimal('penghasilan_ibu', 15, 2)->nullable();
            $table->string('alamat_orang_tua', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orang_tua');
    }
};
