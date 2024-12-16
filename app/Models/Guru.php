<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Guru extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nip',
        'nama_guru',
        'jk',
        'alamat',
        'tmp_lahir',
        'tgl_lahir',
        'telp',
        'email',
        'jabatan',
        'pendidikan_terakhir',
        'tanggal_masuk',
        'gelar',
        'foto',
        'status'
    ];
    
    public function mapel()
    {
        return $this->belongsTo('App\Models\Mapel')->withDefault();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    protected $table = 'guru';
}
