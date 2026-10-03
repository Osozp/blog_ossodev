<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'status',
        'ip_address',
        'country'
    ];

    protected function statusColor(): Attribute
    {
        return Attribute::make(
            get: fn () => match ($this->status){
                'activo'        => 'green',
                'registrado'    => 'yellow',
                'de_baja'       => 'red',
                default         => 'gray',
            }
        );
    }

    protected function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn()=> match ($this->status){
                'activo'        => 'Activo',
                'registrado'    => 'Registrado',
                'de_baja'       => 'De baja',
                default => 'Desconocido',
            }
        );
    }
}
