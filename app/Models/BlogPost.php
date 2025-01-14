<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BlogPost extends Model
{
    protected $table = 'blog_post';
    protected $fillable = ['title', 'slug', 'kategori_id', 'users_id', 'content', 'image'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(BlogKategori::class, 'kategori_id', 'id');
    }

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
