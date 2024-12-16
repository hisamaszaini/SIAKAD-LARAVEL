<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = "orang_tua";
    protected $fillable = [
        'siswa_id',
        'nama_ayah',
        'telp_ayah',
        'pekerjaan_ayah',
        'penghasilan_ayah',
        'nama_ibu',
        'telp_ibu',
        'pekerjaan_ibu',
        'penghasilan_ibu',
        'alamat_orang_tua',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }
}
