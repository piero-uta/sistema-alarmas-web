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
        $logo ='https://www.gravatar.com/avatar/'.md5(strtolower(trim($this->faker->email()))).'?d=identicon';

        return [
            'rut'=>$this->faker->numberBetween(10000000,999999999),
            'digito'=>$this->faker->numberBetween(1,9),
            'razon_social'=>'Comunidad '.$this->faker->name(),
            'representante_legal'=> $this->faker->name(),
            'email'=> $this->faker->name().'@'.$this->faker->name().'.com',
            'direccion'=>'Calle '.$this->faker->name().', '.$this->faker->name().' # '.$this->faker->numberBetween(1,100),
            'giro'=>$this->faker->word(),
            'tipo_servicio'=>'Administracion',
            'logo'=>$logo,
            'costo_mensual'=>$this->faker->numberBetween(100000,999999),
        ];
    }
}
