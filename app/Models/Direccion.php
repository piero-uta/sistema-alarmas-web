<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';

    protected $fillable = [
        'rut',
        'digito',
        'codigo',
        'calle',
        'numero',
        'piso',
        'latitud',
        'longitud',
        'representante',
        'telefono',
        'celular',
        'motivo_activo',
        'activo',
        'comunidad_id',
    ];


}
