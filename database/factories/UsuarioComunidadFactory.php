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
        return [
            'activo'=>true,
            'usuario_id'=> User::inRandomOrder()->first()->id,
            'comunidad_id'=> Comunidad::inRandomOrder()->first()->id,
            'perfil_id'=> Perfil::inRandomOrder()->first()->id,
            'direccion_id'=> Direccion::inRandomOrder()->first()->id
        ];
    }
}
