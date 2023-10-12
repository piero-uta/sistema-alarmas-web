<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nombre = $this->faker->unique()->name();
        $nombreUsuario = str_replace(' ', '', strtolower($nombre));
        $correoElectronico = $nombreUsuario . '@example.com';
        return [
            'email' => $correoElectronico,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'nombre' => $nombre,
            'apellido_paterno'=>$this->faker->word(),
            'apellido_materno'=>$this->faker->word(),
            'activo'=>true

        ];
    }
}
