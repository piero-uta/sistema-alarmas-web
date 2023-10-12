<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Comunidad;
use App\Models\Perfil;
use App\Models\Direccion;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UsuarioComunidad>
 */
class UsuarioComunidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $comunidad = Comunidad::inRandomOrder()->first();

        return [
            'activo'=>true,
            'usuario_id'=> User::inRandomOrder()->first()->id,
            'comunidad_id'=> $comunidad->id,
            'perfil_id' => Perfil::where('comunidad_id', $comunidad->id)->inRandomOrder()->first()->id,
            'direccion_id'=> Direccion::where('comunidad_id', $comunidad->id)->inRandomOrder()->first()->id,
        ];
    }
}
