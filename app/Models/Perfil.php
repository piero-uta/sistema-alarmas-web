<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'perfiles';

    // Schema::create('perfiles', function (Blueprint $table) {
    //     $table->id();
    //     $table->timestamps();
    //     $table->string('nombre');
    //     $table->string('descripcion')->nullable()->default(null);
    //     $table->boolean('activo')->default(true);
    //     //constraint comunidad
    //     $table->foreignId('comunidad_id')->constrained('comunidades');
    // });

    protected $fillable = [
        'nombre',
        'descripcion',
        'activo',
        'comunidad_id',
    ];

}
