<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\UsuarioComunidad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RedAviso>
 */
class RedAvisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $UsuarioComunidad = UsuarioComunidad::inRandomOrder()->first();
        $comunidad_id = $UsuarioComunidad->comunidad_id;
        $direccion_id = $UsuarioComunidad->direccion_id;
        $direccion_vecino = UsuarioComunidad::where('comunidad_id', $comunidad_id)->inRandomOrder()->first()->direccion_id;

        return [
            'direccion_id'=>$direccion_id,
            'direccion_vecino_id'=> $direccion_vecino,
            'activo'=>true
        ];
    }
}
