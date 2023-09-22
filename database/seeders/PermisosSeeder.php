<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permiso;

class PermisosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ver y modificar para: usuarios, perfiles, direcciones
        $permisos = [
            // [
            //     'nombre' => 'admin',
            //     'descripcion' => 'Administrador',
            // ],
            [
                'nombre' => 'ver_usuarios',
                'descripcion' => 'Ver usuarios',
            ],
            [
                'nombre' => 'modificar_usuarios',
                'descripcion' => 'Modificar usuarios',
            ],
            [
                'nombre' => 'ver_perfiles',
                'descripcion' => 'Ver perfiles',
            ],
            [
                'nombre' => 'modificar_perfiles',
                'descripcion' => 'Modificar perfiles',
            ],
            [
                'nombre' => 'ver_direcciones',
                'descripcion' => 'Ver direcciones',
            ],
            [
                'nombre' => 'modificar_direcciones',
                'descripcion' => 'Modificar direcciones',
            ]

        ] ;

        foreach ($permisos as $permiso) {
            Permiso::create($permiso);
        }



    }
}
