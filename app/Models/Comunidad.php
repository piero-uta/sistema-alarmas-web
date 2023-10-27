<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comunidad;
use App\Models\Perfil;
use App\Models\UsuarioComunidad;
use App\Models\Direccion;
use App\Models\User;

class Comunidad extends Model
{
    use HasFactory;

    protected $table = 'comunidades';

    protected $fillable = [        
        'rut',
        'digito',
        'razon_social',
        'representante_legal',
        'email',
        'direccion',
        'giro',
        'tipo_servicio',
        'costo_mensual',
        'telefono',
        'celular',
        'logo',
        'activo',
        'zoom',
        'latitud',
        'longitud',
    ];

    public function perfilesPorDefecto()
    {
        $perfiles = [
            [
                'nombre' => 'Administrador',
                'descripcion' => 'Administrador de la comunidad',
            ],
            [
                'nombre' => 'Conserje',
                'descripcion' => 'Conserje de la comunidad',
            ],
            [
                'nombre' => 'Residente',
                'descripcion' => 'Residente de la comunidad',
            ],
        ];
        foreach ($perfiles as $perfil) {
            $perfil['comunidad_id'] = $this->id;
            Perfil::create($perfil);
        }
    }

    public function usuarios()
    {
        $usuarioComunidad = UsuarioComunidad::where('comunidad_id', $this->id)->get();
        $usuarios = [];
        foreach ($usuarioComunidad as $uc) {
            $usuarios[] = User::find($uc->usuario_id);
        }
        return $usuarios;
    }


}
