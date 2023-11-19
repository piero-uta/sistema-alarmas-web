<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Chequeo extends Model
{
    use HasFactory;
    protected $table = 'chequeos';

    protected $fillable = [
        'id',
        'alarma_id',
        'fecha',
        'hora',
        'usuario_chequeo',
        'estado_chequeo',
        'vecino_chequeo',
        'observacion',
        'tipo_chequeo',
        'tipo_evento',
    ];

}
