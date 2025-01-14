<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Siswa extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'no_induk',
        'nisn',
        'nama',
        'kelas_id',
        'jk',
        'telp',
        'tmp_lahir',
        'tgl_lahir',
        'tgl_masuk',
        'alamat',
        'foto',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orangTua()
    {
        return $this->hasOne(OrangTua::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kelas_id', 'kelas_id');
    }

    function mapel()
    {
        return $this->belongsToMany(Mapel::class, 'jadwal', 'kelas_id', 'mapel_id');
    }

    public function kehadiran()
    {
        return $this->hasMany(Kehadiran::class, 'siswa_id');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'siswa_id');
    }

    public function rapot()
    {
        return $this->hasMany(Rapot::class, 'siswa_id');
    }

    public function penagihan()
    {
        return $this->hasMany(Penagihan::class);
    }

    protected $table = 'siswa';
}
