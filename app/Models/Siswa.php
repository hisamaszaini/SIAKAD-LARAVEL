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
        'nama_siswa',
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

    protected $table = 'siswa';
}
