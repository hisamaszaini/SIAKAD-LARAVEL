<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penagihan extends Model
{
    protected $table = "penagihan";
    
    protected $fillable = ['siswa_id', 'tagihan_id', 'status', 'tgl_dibayar'];

    public $timestamps = false;

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

}
