<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alarma extends Model
{
    use HasFactory;

    protected $table = 'alarmas';

    protected $fillable = [
        'direccion_id',
        'fecha',
        'hora',
        'nombre_usuario',
        'codigo',
        'activo',
        'chequeo',
        'dispositivo_id'
    ];
}
