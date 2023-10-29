<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Permiso;
use App\Models\Perfil;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermisoPerfil>
 */
class PermisoPerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'perfil_id'=> Perfil::inRandomOrder()->first()->id,
            'permiso_id'=> Permiso::inRandomOrder()->first()->id
        ];
    }
}
