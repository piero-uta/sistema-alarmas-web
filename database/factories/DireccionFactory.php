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
        return [
            'comunidad_id'=>Comunidad::inRandomOrder()->first()->id,
            'rut'=> $rut,
            'digito'=>$this->faker->numberBetween(1,9),
            'codigo'=>strtoupper($calle).'-'.$numero,
            'calle'=> $calle,
            'numero'=> $numero,
            'piso' => $this->faker->numberBetween(1,10),
            'longitud'=> $this->faker->randomFloat(2,50,10000),
            'latitud'=> $this->faker->randomFloat(2,50,10000),
            'representante'=> $this->faker->name(),
            'telefono'=> $this->faker->numberBetween(100,999).'-'.$this->faker->numberBetween(100,999).'-'.$this->faker->numberBetween(100,999),
            'celular'=> $this->faker->numberBetween(100,999).' '.$this->faker->numberBetween(100,999).' '.$this->faker->numberBetween(100,999),
            'motivo_activo' => $this->faker->numberBetween(0,1),
            'activo'=>true
        ];
    }
}
