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
        Schema::create('rapot', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->unsignedBigInteger('kelas_id');
            $table->unsignedBigInteger('guru_id');
            $table->unsignedBigInteger('mapel_id');
            $table->decimal('p_nilai', 5, 2)->nullable();
            $table->char('p_predikat', 1)->nullable(); 
            $table->text('p_deskripsi')->nullable();
            $table->decimal('k_nilai', 5, 2)->nullable();
            $table->char('k_predikat', 1)->nullable();
            $table->text('k_deskripsi')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
            $table->foreign('guru_id')->references('id')->on('guru')->onDelete('cascade');
            $table->foreign('mapel_id')->references('id')->on('mapel')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rapot');
    }
};
