<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{

    const STATUS_HADIR = 1;
    const STATUS_TIDAK_HADIR = 2;
    const STATUS_SAKIT = 3;
    const STATUS_IZIN = 4;

    public $timestamps = false; 

    protected $fillable = [
        'siswa_id',
        'absensi_id',
        'status',
    ];

    public function getStatusLabel($status)
    {
        switch ($status) {
            case self::STATUS_HADIR:
                return 'Hadir';
            case self::STATUS_TIDAK_HADIR:
                return 'Tidak Hadir';
            case self::STATUS_SAKIT:
                return 'Sakit';
            case self::STATUS_IZIN:
                return 'Izin';
            default:
                return 'Unknown';
        }
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    protected $table = 'kehadiran';
}
