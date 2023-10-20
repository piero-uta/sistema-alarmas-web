<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direccion;
use App\Models\Comunidad;
use App\Models\User;
use App\Models\Perfil;
use App\Models\UsuarioComunidad;
use App\Models\RedAviso;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Comunidad::factory(10)->create();
        Direccion::factory(100)->create();
        Perfil::factory(100)->create();
        User::factory(1000)->create();
        UsuarioComunidad::factory(1000)->create();
        RedAviso::factory(100)->create();
        $this->call(AdminSeeder::class);

        // Direccion::factory(100)->create();
        // \App\Models\User::factory(10)->create();
    }
}
