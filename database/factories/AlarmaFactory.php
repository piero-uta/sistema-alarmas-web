<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UsuarioComunidad;
use App\Models\User;
use App\Models\Direccion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alarma>
 */
class AlarmaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $fecha = now()->toDateString(); // Obtén la fecha actual en formato YYYY-MM-DD
        $hora = now()->toTimeString(); // Obtén la hora actual en formato HH:MM:SS
        


        $usuarioComunidad = UsuarioComunidad::inRandomOrder()->first();
        $usuario = User::where('id', $usuarioComunidad->usuario_id)->first();
        $direccion = Direccion::where('id', $usuarioComunidad->direccion_id)->first();

        return [
            'direccion_id' => $direccion->id,
            'fecha'=> $fecha,
            'hora'=>$hora,
            'nombre_usuario'=> $usuario->nombre,
            'codigo'=>$direccion->codigo,
            'chequeo'=> 1
        ];
    }
}
