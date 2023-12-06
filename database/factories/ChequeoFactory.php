<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UsuarioComunidad;
use App\Models\User;
use App\Models\Direccion;
use App\Models\Alarma;


class ChequeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {    
        $fecha= now()->toDateString();
        $hora=  now()->toTimeString();

        $usuarioComunidad = UsuarioComunidad::inRandomOrder()->first();
        $usuario = User::where('id', $usuarioComunidad->usuario_id)->first();
        $direccion = Direccion::where('id', $usuarioComunidad->direccion_id)->first();
        $alarma = Alarma::whereIn('direccion_id', $direccion->pluck('id'))->inRandomOrder()->first();

        return [
            'alarma_id' => $alarma->id, // Asegúrate de que al inicio esté en blanco
            'fecha' => $fecha, // Establece los valores deseados
            'hora' => $hora,
            'usuario_chequeo' => null,
            'estado_chequeo' => 0,
            'vecino_chequeo' => $usuario->nombre, // Usando el nombre del usuario de la alarma
            'observacion' => '',
            'tipo_chequeo' => null,
            'tipo_evento' => null,
         ];
    }
}