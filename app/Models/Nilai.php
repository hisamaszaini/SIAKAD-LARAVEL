<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{

    public $timestamps = false;

    protected $fillable = ['guru_id', 'mapel_id', 'jadwal_id', 'deskripsi_a', 'deskripsi_b', 'deskripsi_c', 'deskripsi_d'];

    protected $table = 'nilai';

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function getPredikat(float $nilai)
    {
        if ($nilai >= 90) {
            return 'A';
        } elseif ($nilai >= 80) {
            return 'B';
        } elseif ($nilai >= 70) {
            return 'C';
        } else {
            return 'D';
        }
    }

    public function getDeskripsi(string $predikat)
    {
        switch ($predikat) {
            case 'A':
                return $this->deskripsi_a;
            case 'B':
                return $this->deskripsi_b;
            case 'C':
                return $this->deskripsi_c;
            case 'D':
                return $this->deskripsi_d;
            default:
                return 'Tidak ada deskripsi';
        }
    }
}
