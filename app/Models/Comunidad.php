<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidades';

    protected $fillable = [        
        'rut',
        'digito',
        'razon_social',
        'representante_legal',
        'email',
        'direccion',
        'giro',
        'tipo_servicio',
        'costo_mensual',
        'telefono',
        'celular',
        'logo',
        'activo',
    ];
}
