<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Direccion;
use Illuminate\Support\Facades\Session;
use App\Models\RedAviso;

class RedesAvisos extends Controller
{
    //
    public function index(Request $request)
    {
        // obtener comunidad en session
        $comunidad_id = Session::get('comunidad_id');
        // obtener todas las direcciones de la comunidad
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();
        // obtener redes de aviso con direccion_id = $request->direccion_id
        $redes = RedAviso::where('direccion_id', $request->direccion_id)->get();
        $parametros = [
            'direccion_id' => $request->direccion_id,
            'direcciones' => $direcciones,
            'redes' => $redes,
        ];
        // retornar la vista red-avisos.index
        return view('redAviso.index', $parametros);
    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        $direccionSeleccionada = Direccion::where('id', $request->direccion_id)->first();
        if(!$direccionSeleccionada){
            //agregar error a parametros
            $parametros['error'] = 'Direccion no encontrada';
            return redirect()->route('redAviso.index')->with($parametros);
        }
        $parametros['direccionSeleccionada'] = $direccionSeleccionada;
        // obtener redes de aviso con direccion_id = $request->direccion_id
        $redes = RedAviso::where('direccion_id', $request->direccion_id)->get();
        if($request->has('id')){
            //buscar red
            $red = RedAviso::where('id', $request->id)->first();
            if(!$red){
                //agregar error a parametros
                $parametros['error'] = 'Red de aviso no encontrada';
                return redirect()->route('redAviso.index')->with($parametros);
            }
            $parametros['red'] = $red;
            // quitar red de redes
            $redes = $redes->where('id', '!=', $red->id);
        }
        // obtener comunidad en session
        $comunidad_id = Session::get('comunidad_id');
        // obtener todas las direcciones de la comunidad, excepto la seleccionada y las que ya tienen red de aviso
        $direcciones = Direccion::where('comunidad_id', $comunidad_id)->where('id', '!=', $request->direccion_id)->whereNotIn('id', $redes->pluck('direccion_vecino_id'))->get();
        $parametros['direcciones'] = $direcciones;
        
        return view('redAviso.guardar', $parametros);
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
                return redirect()->route('redAviso.index')->with($parametros);
            }
        }else{
            $red = new RedAviso();
        }
        $red->direccion_id = $request->direccion_id;
        $red->direccion_vecino_id = $request->direccion_vecino_id;
        if($request->has('activo')){
            $red->activo = 1;
        }else{
            $red->activo = 0;
        }
        $red->save();
        return redirect()->route('red-avisos.index');
    }

    public function eliminar(Request $request)
    {
        $request->validate([
            'id' => 'required',
        ]);
        $red = RedAviso::where('id', $request->id)->first();
        if(!$red){
            //agregar error a parametros
            $parametros['error'] = 'Red de aviso no encontrada';
            return redirect()->route('redAviso.index')->with($parametros);
        }
        $red->delete();
        return redirect()->route('red-avisos.index');
    }

}
