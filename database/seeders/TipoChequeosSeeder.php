<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoChequeo;

class TipoChequeosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //tipo de chequeo segun el medio que se ocupa para realizar el chequeo
        // presencial, llamada, mensaje, correo, otro, etc
        TipoChequeo::create([
            'nombre' => 'Presencial',
        ]);
        TipoChequeo::create([
            'nombre' => 'Llamada',
        ]);
        TipoChequeo::create([
            'nombre' => 'Mensaje',
        ]);
        TipoChequeo::create([
            'nombre' => 'Correo',
        ]);
        TipoChequeo::create([
            'nombre' => 'Otro',
        ]);
        


    }
}
