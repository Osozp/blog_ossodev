<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = ['subject', 'body', 'status', 'sent_at'];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

     protected function statusColor(): Attribute
    {
        return Attribute::get(fn () => $this->sent_at ? 'green' : 'zinc');
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::get(fn()=> $this->sent_at ? 'Enviado' : 'Borrador');
    }
}
