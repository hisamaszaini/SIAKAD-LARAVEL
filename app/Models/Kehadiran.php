<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{

    const STATUS_HADIR = 1;
    const STATUS_TIDAK_HADIR = 2;
    const STATUS_SAKIT = 3;
    const STATUS_IZIN = 4;
    
    const STATUS_LABELS = [
        self::STATUS_HADIR => 'Hadir',
        self::STATUS_TIDAK_HADIR => 'Tidak Hadir',
        self::STATUS_SAKIT => 'Sakit',
        self::STATUS_IZIN => 'Izin',
    ];

    public $timestamps = false; 

    protected $fillable = [
        'siswa_id',
        'absensi_id',
        'status',
    ];

    public function getStatusLabelAttribute()
    {
        return self::STATUS_LABELS[$this->status] ?? 'Unknown';
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function absensi()
    {
        return $this->belongsTo(Absensi::class);
    }

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    protected $table = 'kehadiran';
}
