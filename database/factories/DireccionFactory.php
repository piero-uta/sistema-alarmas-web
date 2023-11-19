<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comunidad;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Direccion>
 */
class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rut = $this->faker->unique()->numberBetween(10000000,99999999);
        $calle = $this->faker->word();
        $numero = $this->faker->numberBetween(1,999);

        $latitud_base = -33.4569400;
        $longitud_base = -70.6482700;

        // crear latitud y longitud dentro de un radio de 1000 metros
        $latitud = $latitud_base + $this->faker->randomFloat(6,-0.009,0.009);
        $longitud = $longitud_base + $this->faker->randomFloat(6,-0.009,0.009);

        return [
            'comunidad_id'=>Comunidad::inRandomOrder()->first()->id,
            'rut'=> $rut,
            'digito'=>$this->faker->numberBetween(1,9),
            'codigo'=>strtoupper($calle).'-'.$numero,
            'calle'=> $calle,
            'numero'=> $numero,
            'piso' => $this->faker->numberBetween(1,10),
            'longitud'=> $longitud,
            'latitud'=> $latitud,
            'representante'=> $this->faker->name(),
            'telefono'=> $this->faker->numberBetween(100,999).'-'.$this->faker->numberBetween(100,999).'-'.$this->faker->numberBetween(100,999),
            'celular'=> $this->faker->numberBetween(100,999).' '.$this->faker->numberBetween(100,999).' '.$this->faker->numberBetween(100,999),
            'motivo_activo' => $this->faker->numberBetween(0,1),
            'activo'=>true
        ];
    }
}
