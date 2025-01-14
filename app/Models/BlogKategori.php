<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogKategori extends Model
{
    protected $table = "blog_kategori";
    protected $fillable = ['nama', 'slug', 'deskripsi'];

    public function post(): HasMany
    {
        return $this->hasMany(BlogPost::class, 'kategori_id', 'id');
    }
}
