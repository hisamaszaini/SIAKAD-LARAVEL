<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'app_nama' => 'Sistem Informasi Akademik',
            'app_namapendek' => 'SIAKAD',
            'pagination' => 12,
            'lembaga_nama' => 'SMP Cendekia Ponorogo',
            'lembaga_jalan' => 'Jl. Pendidikan No. 1',
            'lembaga_telp' => '081234567890',
            'lembaga_kota' => 'Kota Ponorogo',
            'lembaga_logo' => 'logo/lembaga_logo.png',
            'sekolah_logo' => 'logo/sekolah_logo.png',
            'nama_kepsek' => 'Dr. John Doe',
            'nominaltagihan' => 25000,
            'semesteraktif' => 1,
        ]);
    }
}
