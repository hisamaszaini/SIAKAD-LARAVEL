<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rapot extends Model
{
    protected $fillable = ['siswa_id', 'kelas_id', 'guru_id', 'mapel_id', 'p_nilai', 'p_predikat', 'p_deskripsi', 'k_nilai', 'k_predikat', 'k_deskripsi'];

    protected $table = 'rapot';

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id');
    }
    
}