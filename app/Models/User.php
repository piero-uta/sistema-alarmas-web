<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Perfil;
use App\Models\Permiso;
use App\Models\UsuarioComunidad;
use App\Models\Comunidad;
use App\Models\Direccion;
use App\Models\PermisoPerfil;


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
        'token_celular'
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

    public function getAllPerfiles()
    {
        //return all perfiles of the user
        $usuarioComunidad = UsuarioComunidad::where('user_id', $this->id)->get();
        $perfiles = [];
        foreach ($usuarioComunidad as $uc) {
            $perfiles[] = Perfil::where('id', $uc->perfil_id)->first();
        }
    }

    public function esAdmin()
    {
        
    }
    
    public function tienePermiso(string $permiso)
    {
        return $this->perfil->permisos->contains('nombre', $permiso);
    }

}
