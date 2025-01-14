<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
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
        Schema::create('blog_kategori', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 50)->unique();
            $table->string('slug')->unique();
            $table->string('deskripsi', 120)->nullable();
            $table->timestamps();
        });

        DB::table('blog_kategori')->insert([
            'id' => 1,
            'nama' => 'Tak Berkategori',
            'slug' => Str::slug('Tak Berkategori'),
            'deskripsi' => 'Lorem ipsum absir jamit.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS set_default_category');
        
        // Hapus tabel
        Schema::dropIfExists('blog_post');
        Schema::dropIfExists('blog_kategori');
    }
};
