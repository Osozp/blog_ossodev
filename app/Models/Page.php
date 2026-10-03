<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'body',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    protected function statusColor(): Attribute
    {
        return Attribute::get(fn () => $this->is_published ? 'green' : 'zinc');
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::get(fn()=> $this->is_published ? 'Publicado' : 'Borrador');
    }
}
