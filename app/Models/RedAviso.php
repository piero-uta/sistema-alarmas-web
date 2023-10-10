<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RedAviso extends Model
{
    use HasFactory;

    protected $table = 'redes_avisos';

    protected $fillable = [
        'activo',
        'direccion_id',
        'direccion_vecino_id',
    ];
}
