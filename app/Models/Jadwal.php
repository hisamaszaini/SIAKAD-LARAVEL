<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jadwal extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'jadwal';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kelas_id',
        'mapel_id',
        'ruang_id',
        'guru_id',
        'jam_pelajaran_id',
        'hari_id',
        'semester',
        'tahun_ajaran'
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['kelas', 'mapel', 'ruang', 'guru', 'jamPelajaran', 'hari'];

    /**
     * Relationship with Kelas
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    /**
     * Relationship with Mapel
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    /**
     * Relationship with Ruang
     */
    public function ruang()
    {
        return $this->belongsTo(Ruang::class);
    }

    /**
     * Relationship with Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /**
     * Relationship with JamPelajaran
     */
    public function jamPelajaran()
    {
        return $this->belongsTo(JamPelajaran::class);
    }

    /**
     * Relationship with Hari
     */
    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }
}
