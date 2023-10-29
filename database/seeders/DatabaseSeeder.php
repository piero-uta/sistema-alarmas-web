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
use App\Models\Alarma;
use App\Models\Permiso;
use App\Models\PermisoPerfil;

use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Comunidad::factory(10)->create();
        Direccion::factory(100)->create();

        Perfil::factory(1000)->create();
        DB::statement("
            DELETE p1
            FROM perfiles p1
            INNER JOIN perfiles p2
            WHERE p1.id > p2.id
            AND p1.nombre = p2.nombre
            AND p1.comunidad_id = p2.comunidad_id
        ");

        User::factory(1000)->create();
        UsuarioComunidad::factory(1000)->create();
        DB::statement("
            DELETE u1
            FROM usuarios_comunidad u1
            INNER JOIN usuarios_comunidad u2
            WHERE u1.id <> u2.id
            AND u1.usuario_id = u2.usuario_id
            AND u1.perfil_id = u2.perfil_id
            AND u1.comunidad_id = u2.comunidad_id
        ");

        RedAviso::factory(500)->create();
        DB::statement("
            DELETE ra1
            FROM redes_avisos ra1
            INNER JOIN redes_avisos ra2
            WHERE ra1.id <> ra2.id
            AND ra1.direccion_id = ra2.direccion_id
            AND ra1.direccion_vecino_id = ra2.direccion_vecino_id
        ");
        $this->call(AdminSeeder::class);
        Alarma::factory(70)->create();

        Permiso::factory(1000)->create();
        DB::statement("
            DELETE p1
            FROM permisos p1
            INNER JOIN permisos p2
            WHERE p1.id > p2.id
            AND p1.nombre = p2.nombre
            AND p1.descripcion = p2.descripcion
        ");
        PermisoPerfil::factory(1500)->create();
        DB::statement("
            DELETE p1
            FROM permisos_perfil p1
            INNER JOIN permisos_perfil p2
            WHERE p1.id <> p2.id
            AND p1.perfil_id = p2.perfil_id
            AND p1.permiso_id = p2.permiso_id
        ");

        // Direccion::factory(100)->create();
        // \App\Models\User::factory(10)->create();
    }
}
