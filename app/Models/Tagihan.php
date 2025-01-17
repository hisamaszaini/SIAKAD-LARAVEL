<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table    = 'tagihan';
    protected $fillable = [ 'nama', 'nominal', 'keterangan', 'tingkatan', 'semester', 'tgl_tagihan', 'tgl_tempo'];

    public function penagihan()
    {
        return $this->hasMany(Penagihan::class, 'tagihan_id');
    }
}
