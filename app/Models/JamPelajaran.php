<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JamPelajaran extends Model
{
    use SoftDeletes;

    protected $fillable = ['nama_jam', 'jam_mulai', 'jam_selesai', 'urutan'];

    protected $table = "jam_pelajaran";

}
