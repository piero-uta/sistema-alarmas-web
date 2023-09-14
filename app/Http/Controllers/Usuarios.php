<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class Usuarios extends Controller
{
    //
    public function index()
    {
        //obtener todos los usuarios
        $usuarios = User::all();
        //retornar la vista usuarios.index
        return view('usuarios.index', compact('usuarios'));
    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        if($request->has('id')){
            $usuario = User::find($request->id);
            if(!$usuario){
                //agregar error a parametros
                $parametros['error'] = 'Usaurio no encontrada';
                return redirect()->route('usuarios.index')->with($parametros);
            }
            $parametros['usuario'] = $usuario;
        }
        return view('usuarios.guardar', $parametros);
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'apellido_paterno' => 'required',
            'apellido_materno' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        if($request->has('id')){
            $usuario = User::find($request->id);
            if(!$usuario){
                //agregar error a parametros
                $parametros['error'] = 'Usaurio no encontrada';
                return redirect()->route('usuarios.index')->with($parametros);
            }
        }else{
            $usuario = new User();
        }
        $usuario->nombre = $request->nombre;
        $usuario->apellido_paterno = $request->apellido_paterno;
        $usuario->apellido_materno = $request->apellido_materno;
        $usuario->email = $request->email;
        $usuario->password = $request->password;
        if($request->has('activo')){
            $usuario->activo = 1;
        }else{
            $usuario->activo = 0;
        }
        $usuario->save();
        $parametros['success'] = 'Usuario' . $request->nombre . 'guardado';
        return redirect()->route('usuarios.index')->with($parametros);
        
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $usuario = User::find($request->id);
        if(!$usuario){
            //agregar error a parametros
            $parametros['error'] = 'Usuario no encontrada';
            return redirect()->route('usuarios.index')->with($parametros);
        }
        $nombre = $usuario->nombre;
        $usuario->delete();
        //success
        $parametros['success'] = 'Usuario' . $nombre . 'eliminada';
        return redirect()->route('usuarios.index')->with($parametros);
    }
    
}
