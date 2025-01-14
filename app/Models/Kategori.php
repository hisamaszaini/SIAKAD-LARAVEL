<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
    ];

    public function mapels()
    {
        return $this->hasMany(Mapel::class, 'kategori_id');
    }
}