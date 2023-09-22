<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunidad;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\UsuarioComunidad;

class Comunidades extends Controller
{
    public function index()
    {
        //obtener todas las comunidades
        $comunidades = Comunidad::all();
        //retornar la vista comunidades.index
        return view('comunidades.index', compact('comunidades'));
    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        if($request->has('id')){
            $comunidad = Comunidad::find($request->id);
            if(!$comunidad){
                //agregar error a parametros
                $parametros['error'] = 'Comunidad no encontrada';
                return redirect()->route('comunidades.index')->with($parametros);
            }
            $parametros['comunidad'] = $comunidad;
        }
        //retornar la vista comunidades.crearEditar con parametros
        return view('comunidades.guardar', $parametros);
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'razon_social' => 'required',
            'rut' => 'required',
            'digito' => 'required',
            'direccion' => 'required',
            'tipo_servicio' => 'required',
            'costo_mensual' => 'required',

        ]);
        if($request->has('id')){
            $comunidad = Comunidad::find($request->id);
            if(!$comunidad){
                //agregar error a parametros
                $parametros['error'] = 'Comunidad no encontrada';
                return redirect()->route('comunidades.index')->with($parametros);
            }
        }else{
            $comunidad = new Comunidad();
        }
        $comunidad->razon_social = $request->razon_social;
        $comunidad->rut = $request->rut;
        $comunidad->digito = $request->digito;
        $comunidad->direccion = $request->direccion;
        $comunidad->tipo_servicio = $request->tipo_servicio;
        $comunidad->costo_mensual = $request->costo_mensual;

        $comunidad->representante_legal = $request->representante_legal;        
        $comunidad->email = $request->email;        
        $comunidad->giro = $request->giro;
        $comunidad->telefono = $request->telefono;
        $comunidad->celular = $request->celular;
        $comunidad->logo = $request->logo;

        if($request->has('activo')){
            $comunidad->activo = 1;
        }else{
            $comunidad->activo = 0;
        }

        $comunidad->save();
        $comunidad->perfilesPorDefecto();
        $parametros['success'] = 'Comunidad' . $request->razon_social . 'guardada';
        return redirect()->route('comunidades.index')->with($parametros);
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $comunidad = Comunidad::find($request->id);
        if(!$comunidad){
            //agregar error a parametros
            $parametros['error'] = 'Comunidad no encontrada';
            return redirect()->route('comunidades.index')->with($parametros);
        }
        $razonSocial = $comunidad->razon_social;
        $comunidad->delete();
        //success
        $parametros['success'] = 'Comunidad' . $razonSocial . 'eliminada';
        return redirect()->route('comunidades.index')->with($parametros);
    }
    


    public function handleSeleccionarComunidad($comunidad_id)
    {
        if(!self::setComunidadActual($comunidad_id)){
            return redirect()->route('login');
        }
        return redirect()->route('welcome');
    }

    static public function setComunidadActual($comunidad_id)
    {
        $usuario = Auth::user();
        if(!$usuario){
            return false;
        }
        if($usuario->esAdmin()){
            Session::put('comunidad_id', $comunidad_id);
            return true;
        }

        $usuarioComunidad = UsuarioComunidad::where('usuario_id', $usuario->id)->where('comunidad_id', $comunidad_id)->first();

        if(!$usuarioComunidad){
            return false;
        }

        Session::put('comunidad_id', $comunidad_id);
        return true;
    }

    static public function getComundadActual()
    {
        if(!Session::has('comunidad_id')){
            return null;
        }

        $comunidad_id = Session::get('comunidad_id');

        return Comunidad::find($comunidad_id);

    }
}
