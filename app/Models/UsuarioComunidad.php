<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsuarioComunidad extends Model
{
    use HasFactory;

    protected $table = 'usuarios_comunidad';

    protected $fillable = [
        'activo',
        'usuario_id',
        'comunidad_id',
        'perfil_id',
        'direccion_id',
    ];
}
