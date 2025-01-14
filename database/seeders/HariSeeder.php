<?php

namespace Database\Seeders;

use App\Models\Hari;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HariSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hari = [
            ['nama_hari' => 'Senin'],
            ['nama_hari' => 'Selasa'],
            ['nama_hari' => 'Rabu'],
            ['nama_hari' => 'Kamis'],
            ['nama_hari' => 'Jumat'],
            ['nama_hari' => 'Sabtu'],
            ['nama_hari' => 'Minggu'],
        ];

        DB::table('hari')->insert($hari);
    }
}