<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Direcciones extends Controller
{
    //
    public function index()
    {
        //obtener todos los usuarios
        $direcciones = Direccion::all();
        //retornar la vista usuarios.index
        return view('direcciones.index', compact('direcciones'));
    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        if($request->has('id')){
            $direccion = Direccion::find($request->id);
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
            'comunidad_id' => 'required',
        ]);
        if($request->has('id')){
            $direccion = Direccion::find($request->id);
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
        $direccion->comunidad_id = $request->comunidad_id;
        
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

}
