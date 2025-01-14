<?php
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
        Schema::create('blog_post', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->foreignId('kategori_id')
                ->default(1)
                ->constrained('blog_kategori')
                ->cascadeOnUpdate();
            $table->foreignId('users_id', 'fk_post_users')->constrained('users');
            $table->text('content');
            $table->string('image')->nullable();
            $table->timestamps();
        });

        DB::unprepared('
        CREATE TRIGGER set_default_category
        BEFORE DELETE ON blog_kategori
        FOR EACH ROW
        BEGIN
            UPDATE blog_post
            SET kategori_id = 1
            WHERE kategori_id = OLD.id;
        END;
    ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS set_default_category');

        Schema::dropIfExists('blog_post');
    }
};
