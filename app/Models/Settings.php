<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "settings";
    protected $fillable = [
        'app_nama',
        'app_namapendek',
        'pagination',
        'lembaga_nama',
        'lembaga_jalan',
        'lembaga_telp',
        'lembaga_kota',
        'lembaga_logo',
        'sekolah_logo',
        'nama_kepsek',
        'nominaltagihan',
        'semesteraktif',
    ];
}
