<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Permiso;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permiso>
 */
class PermisoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $options = ['DashboardMonitoreo', 'BotonAlarma', 'Comunidad','DireccionesUsuario','Usuarios','AsignacionPerfiles','Perfiles','RedAviso'];
        $actions = ['create', 'read', 'update','delete'];
        $randomOption = $options[array_rand($options)];
        $randomAction = $actions[array_rand($actions)];
        $nombre = $randomOption . '-' . substr($randomAction, 0, 1);
        $descripcion = $randomOption . '-' . $randomAction;

        return [
            'nombre' => $nombre,
            'descripcion'=> $descripcion,
        ];
    }
}
