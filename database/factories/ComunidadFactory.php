<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comunidad>
 */
class ComunidadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rut'=>$this->faker->numberBetween(100,500),
            'digito'=>$this->faker->numberBetween(1,9),
            'razon_social'=>'Comunidad Nº'.$this->faker->numberBetween(1,100). $this->faker->word,
            'representante_legal'=> $this->faker->name(),
            'email'=> $this->faker->name().'@'.$this->faker->name().'.com',
            'direccion'=>$this->faker->name().', '.$this->faker->name().$this->faker->numberBetween(1,100),
            'giro'=>$this->faker->word(),
            'tipo_servicio'=>$this->faker->numberBetween(1,4),
            'costo_mensual'=>$this->faker->numberBetween(1000,5000),
        ];
    }
}
