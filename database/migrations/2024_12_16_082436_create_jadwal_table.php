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
        Schema::create('jadwal', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
            $table->foreignId('mapel_id')->constrained('mapel')->onDelete('cascade');
            $table->foreignId('ruang_id')->constrained('ruang')->onDelete('cascade');
            $table->foreignId('guru_id')->constrained('guru')->onDelete('cascade');
            $table->foreignId('jam_pelajaran_id')->constrained('jam_pelajaran')->onDelete('cascade');
            $table->foreignId('hari_id')->constrained('hari')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['kelas_id', 'mapel_id', 'guru_id', 'ruang_id', 'hari_id', 'jam_pelajaran_id'], 'jadwal_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal');
    }
};
