<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comunidad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Perfil>
 */
class PerfilFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['admin', 'manager', 'resident'];
        $descriptions = ['Administrador', 'Mantenedor', 'Residente'];
        $randomIndex = array_rand($names);
        $randomName = $names[$randomIndex];
        $randomDescription = $descriptions[$randomIndex];


        return [
            'nombre'=> $randomName,
            'descripcion'=> $randomDescription,
            'activo'=>true,
            'comunidad_id'=>Comunidad::inRandomOrder()->first()->id
        ];
    }
}
