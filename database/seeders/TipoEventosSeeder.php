<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoEvento;

class TipoEventosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tipo de eventos para alarma robo, incendio, falsa alarma, otro etc
        TipoEvento::create([
            'nombre' => 'Robo',
        ]);
        TipoEvento::create([
            'nombre' => 'Incendio',
        ]);
        TipoEvento::create([
            'nombre' => 'Falsa Alarma',
        ]);
        TipoEvento::create([
            'nombre' => 'Otro',
        ]);



    }
}
