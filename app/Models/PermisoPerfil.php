<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoPerfil extends Model
{
    use HasFactory;

    protected $table = 'permisos_perfil';

    protected $fillable = [
        'perfil_id',
        'permiso_id',
    ];
}
