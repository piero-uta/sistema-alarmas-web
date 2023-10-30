<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Perfil;
use App\Models\UsuarioComunidad;
use App\Models\Comunidad;
use App\Models\Direccion;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'activo',
        'avatar',
        'tipo_usuario',
        'telefono',
        'celular',
        'token_celular',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function usuarioComunidad()
    {
        return UsuarioComunidad::where('usuario_id', $this->id)->get();
    }

    public function comunidades()
    {
        if($this->esAdmin()){
            return Comunidad::all();
        }
        //return all comunidades of the user
        $usuarioComunidad = $this->usuarioComunidad();
        // $comunidades = [];
        // foreach ($usuarioComunidad as $uc) {
        //     $comunidades[] = Comunidad::where('id', $uc->comunidad_id)->first();
        // }
        //con una sola peticion eloquent seria
        $comunidades = Comunidad::whereIn('id', $usuarioComunidad->pluck('comunidad_id'))->get();
        return $comunidades;
    }

    public function perfiles()
    {
        //return all perfiles of the user
        $usuarioComunidad = $this->usuarioComunidad();
        $perfiles = [];
        foreach ($usuarioComunidad as $uc) {
            $perfiles[] = Perfil::where('id', $uc->perfil_id)->first();
        }
        return $perfiles;
    }

    public function perfilesComunidad($comunidad_id)
    {
        //return all perfiles of the user
        $usuarioComunidad = $this->usuarioComunidad();
        $perfiles = [];
        foreach ($usuarioComunidad as $uc) {
            if ($uc->comunidad_id == $comunidad_id) {
                $perfiles[] = Perfil::where('id', $uc->perfil_id)->first();
            }
        }
        return $perfiles;
    }

    public function direcciones()
    {
        //return all direcciones of the user
        $usuarioComunidad = $this->usuarioComunidad();
        $direcciones = [];
        foreach ($usuarioComunidad as $uc) {
            $direcciones[] = Direccion::where('id', $uc->direccion_id)->first();
        }
        return $direcciones;
    }

    public function direccionesComunidad($comunidad_id)
    {
        //return all direcciones of the user
        $usuarioComunidad = $this->usuarioComunidad();
        $direcciones = [];
        foreach ($usuarioComunidad as $uc) {
            if ($uc->comunidad_id == $comunidad_id) {
                $direcciones[] = Direccion::where('id', $uc->direccion_id)->first();
            }
        }
        return $direcciones;
    }
    
    public function direccionIdComunidad($comunidad_id)
    {
        $usuarioComunidad = $this->usuarioComunidad();
        foreach ($usuarioComunidad as $uc) {
            if ($uc->comunidad_id == $comunidad_id) {
                return $uc->direccion_id;
            }
        }
        return null;
    }

    public function esAdmin()
    {
        $usuarioComunidad = $this->usuarioComunidad();
        foreach ($usuarioComunidad as $uc) {
            if ($uc->perfil_id == 1) {
                return true;
            }
        }
        return false;        
    }

    public function tienePermiso(string $permiso)
    {
        return $this->perfil->permisos->contains('nombre', $permiso);
    }
    

}
