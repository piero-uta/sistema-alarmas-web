<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use Illuminate\Support\Facades\Session;
use App\Models\RedAviso;

class RedesAvisos extends Controller
{
    //
    public function index()
    {
        // obtener comunidad en session
        $comunidad_id = Session::get('comunidad_id');
        // obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        // obtener todas las redes de la comunidad
        $redes = RedAviso::where('comunidad_id', $comunidad_id)->get();
        $parametros = [
            'direcciones' => $direcciones,
            'redes' => $redes,
        ];
        // retornar la vista red-avisos.index
        return view('red-avisos.index', $parametros);
    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        // obtener comunidad en session
        $comunidad_id = Session::get('comunidad_id');
        // obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        $parametros['direcciones'] = $direcciones;
        if($request->has('id')){
            //buscar red
            $red = RedAviso::where('id', $request->id)->first();
            if(!$redAviso){
                //agregar error a parametros
                $parametros['error'] = 'Red de aviso no encontrada';
                return redirect()->route('red-avisos.index')->with($parametros);
            }
            $parametros['red'] = $red;
        }
        return view('red-avisos.guardar', $parametros);
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'direccion_id' => 'required',
            'direccion_vecino_id' => 'required',
        ]);

        if($request->has('id')){
            $red = RedAviso::where('id', $request->id)->first();
            if(!$red){
                //agregar error a parametros
                $parametros['error'] = 'Red de aviso no encontrada';
                return redirect()->route('red-avisos.index')->with($parametros);
            }
        }else{
            $red = new RedAviso();
        }
        $red->direccion_id = $request->direccion_id;
        $red->direccion_vecino_id = $request->direccion_vecino_id;
        $red->save();
        return redirect()->route('red-avisos.index');
    }

}
