<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['id', 'id_siswa', 'id_mapel', 'id_guru', 'tugas', 'uts', 'uas', 'nilai_akhir', 'nilai_revisi'];

    protected $table = 'nilai';
}
