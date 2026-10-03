<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'cover_image',
        'excerpt',
        'body',
        'published_at',
    ];
}
