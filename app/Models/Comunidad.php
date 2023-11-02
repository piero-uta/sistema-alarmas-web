<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Comunidad;
use App\Models\Perfil;
use App\Models\UsuarioComunidad;
use App\Models\Direccion;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
        $usuarioComunidad = UsuarioComunidad::select(DB::raw('COALESCE(perfiles.nombre, "sin perfil") as perfil'), 'users.*')
        ->leftJoin('users', 'users.id', '=', 'usuarios_comunidad.usuario_id')
        ->leftJoin('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
        ->where('usuarios_comunidad.comunidad_id', $this->id)
        ->get();
        // $usuarioComunidad = UsuarioComunidad::select('perfiles.nombre as perfil', 'users.*')
        // ->leftJoin('users', 'users.id', '=', 'usuarios_comunidad.usuario_id')
        // ->leftJoin('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
        // ->where('usuarios_comunidad.comunidad_id', $this->id)
        // ->get();

        // $usuarioComunidad = UsuarioComunidad::select('perfiles.nombre as perfil', 'users.*')
        // ->join('users', 'users.id', '=', 'usuarios_comunidad.usuario_id')
        // ->join('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
        // ->where('usuarios_comunidad.comunidad_id', $this->id)
        // ->get();

        // $usuarioComunidad = UsuarioComunidad::where('comunidad_id', $this->id)->get();
        // $usuarios = [];
        // foreach ($usuarioComunidad as $uc) {
        //     $usuarios[] = User::find($uc->usuario_id);
        // }
        return $usuarioComunidad;
    }


}
