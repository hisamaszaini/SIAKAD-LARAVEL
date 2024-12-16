<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    public $timestamps = false; 

    protected $fillable = [
        'kelas_id',
        'tanggal',
        'guru_id',
        'updated_by',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class);
    }

    protected $table = 'absensi';

}
