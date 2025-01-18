<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hari = [
            // ['nama' => 'Tak Berkategori',
            //  'slug' => 'tak-berkategori'],
            ['nama' => 'Prestasi',
            'slug' => 'prestasi'],
            ['nama' => 'Pengumuman',
            'slug' => 'pengumuman'],
        ];

        DB::table('blog_kategori')->insert($hari);
    }
}