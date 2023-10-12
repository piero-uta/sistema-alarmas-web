<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Admin;
use App\Models\User;
use App\Models\Permiso;
use App\Models\Perfil;
use App\Models\Comunidad;
use App\Models\PermisoPerfil;
use App\Models\UsuarioComunidad;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::create([
            'nombre' => 'admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('12345678'),
        ]);

        // Crear usuario
        $user = User::create([
            'nombre' => 'admin',
            'apellido_paterno' => 'admin',
            'apellido_materno' => 'admin',
            'email' => 'admin@correo.com',
            'password' => bcrypt('12345678'),
        ]);

        // Crear comunidad
        $comunidad = Comunidad::create([
            'rut' => 12345678,
            'digito' => '9',
            'razon_social' => 'Comunidad de administradores',
            'representante_legal' => 'admin',
            'email' => 'admin@correo.com',
            'direccion' => 'Calle 123',
            'giro' => 'Administracion',
            'tipo_servicio' => 'Administracion',
            'costo_mensual' => 100000,
            'telefono' => '12345678',
            'celular' => '12345678',
            'logo' => 'logo.png',
            'activo' => true,
        ]);

        // Crear perfil
        $perfil = Perfil::create([
            'nombre' => 'admin',
            'descripcion' => 'Administrador',
            'comunidad_id' => $comunidad->id,
        ]);

        // Crear PermisoPerfil
        $permiso = Permiso::create([
            'nombre' => 'admin',
            'descripcion' => 'Administrador',
        ]);

        $permisoPerfil = PermisoPerfil::create([
            'perfil_id' => $perfil->id,
            'permiso_id' => $permiso->id,
        ]);

        // Crear UsuarioComunidad
        $usuarioComunidad = UsuarioComunidad::create([
            'activo' => true,
            'usuario_id' => $user->id,
            'comunidad_id' => $comunidad->id,
            'perfil_id' => $perfil->id,
        ]);






    }
}
