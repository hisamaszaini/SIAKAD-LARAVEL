<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{
    use SoftDeletes;

    protected $fillable = ['nama', 'tingkat', 'guru_id'];
    
    public function guru(){
        return $this->belongsTo('App\Models\Guru')->withDefault();
   }

   public function siswa()
   {
        return $this->hasMany('App\Models\Siswa');
  }

    protected $table = 'kelas';
}
