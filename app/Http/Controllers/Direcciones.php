<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use App\Models\Comunidad;
use App\Models\Perfil;
use App\Models\UsuarioComunidad;
use App\Models\PermisoPerfil;
use Illuminate\Support\Facades\Auth;
use App\Models\Permiso;

use Illuminate\Support\Facades\Session;


class Direcciones extends Controller
{
    //
    public function getPermisos($comunidad){
        $user = Auth::user();
        $usuarioComunidad = UsuarioComunidad::where('usuario_id',$user->id)
        ->where('comunidad_id', $comunidad->id)
        ->get()
        ->toArray();
        $total_result = [];
        foreach ($usuarioComunidad as $uc) {
            $perfil = Perfil::where('id',$uc["perfil_id"])->first();
            $permisoPerfil = PermisoPerfil::where('perfil_id', $perfil->id)
            ->get()
            ->toArray();
            $result = [];
            foreach($permisoPerfil as $pp) {
                $permiso = Permiso::where('id', $pp["permiso_id"])->first();
                array_push($result, $permiso->nombre);
            }
            $total_result = array_merge($result, $total_result);
        }
        return $total_result;
    }

    public function index()
    {
        // obtener comunidad_id en session
        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::find($comunidad_id);

        // obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        // retornar la vista direcciones.index

        $permisos = $this->getPermisos($comunidad);

        if(in_array('DireccionesUsuario-c', $permisos)||
        in_array('DireccionesUsuario-r', $permisos)||
        in_array('DireccionesUsuario-u', $permisos)||
        in_array('DireccionesUsuario-d', $permisos)){
        return view('direcciones.index', compact('direcciones','permisos'));
        }else{
            return view('main-dashboard');

            // return redirect()->route('login');
        }


    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::where('id', $comunidad_id)->first();
        $parametros['comunidad'] = $comunidad;
        if($request->has('id')){
            // verificar comunidad 
            
            $direccion = Direccion::where('id', $request->id)->where('comunidad_id', $comunidad_id)->first();
            if(!$direccion){
                //agregar error a parametros
                $parametros['error'] = 'Direccion no encontrada';
                return redirect()->route('direcciones.index')->with($parametros);
            }
            
            $parametros['direccion'] = $direccion;
        }
        return view('direcciones.guardar', $parametros);
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'rut' => 'required',
            'digito' => 'required',
            'calle' => 'required',
            'numero' => 'required',
            'representante' => 'required',
        ]);

        $comunidad_id = Session::get('comunidad_id');
        if($request->has('id')){
            $direccion = Direccion::where('id', $request->id)->where('comunidad_id', $comunidad_id)->first();
            if(!$direccion){
                //agregar error a parametros
                $parametros['error'] = 'Direccion no encontrada';
                return redirect()->route('direcciones.index')->with($parametros);
            }
        }else{
            $direccion = new Direccion();
        }
        $direccion->rut = $request->rut;
        $direccion->digito = $request->digito;
        $direccion->calle = $request->calle;
        $direccion->numero = $request->numero;
        $direccion->representante = $request->representante;
        $direccion->comunidad_id = $comunidad_id;

        $direccion->codigo = $request->codigo;
        $direccion->piso = $request->piso;
        $direccion->latitud = $request->latitud;
        $direccion->longitud = $request->longitud;
        $direccion->telefono = $request->telefono;
        $direccion->celular = $request->celular;
        $direccion->motivo_activo = $request->motivo_activo;
        if($request->has('activo')){
            $direccion->activo = 1;
        }else{
            $direccion->activo = 0;
        }

        $direccion->save();
        return redirect()->route('direcciones.index')->with(['mensaje' => 'Direccion guardada correctamente']);
    }

    public function eliminar(Request $request)
    {
        $comunidad_id = Session::get('comunidad_id');
        $direccion = Direccion::where('id', $request->id)->where('comunidad_id', $comunidad_id)->first();
        if(!$direccion){
            //agregar error a parametros
            $parametros['error'] = 'Direccion no encontrada';
            return redirect()->route('direcciones.index')->with($parametros);
        }
        $direccion->delete();
        return redirect()->route('direcciones.index')->with(['mensaje' => 'Direccion eliminada correctamente']);
    }

}
