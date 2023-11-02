<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use App\Models\PermisoPerfil;
use App\Models\Permiso;
use App\Models\UsuarioComunidad;
use App\Models\Comunidad;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Direccion;


class Perfiles extends Controller
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
        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::find($comunidad_id);

        $perfiles = Perfil::where('comunidad_id',$comunidad_id)
        ->distinct()
        ->get();


        $permisos = $this->getPermisos($comunidad);

        if(in_array('Perfiles-c', $permisos)||
        in_array('Perfiles-r', $permisos)||
        in_array('Perfiles-u', $permisos)||
        in_array('Perfiles-d', $permisos)){
        return view('perfiles.index', compact('perfiles','permisos'));
        }else{
            return view('main-dashboard');
            // return redirect()->route('login');
        }


    }

    public function formularioGuardar(Request $request)
    {
        $parametros = [];
        $comunidad_id = Session::get('comunidad_id');
        if($request->has('id')){
            $perfil = Perfil::find($request->id);
            $parametros['perfil'] = $perfil;

        }

        return view('perfiles.guardar', $parametros);
    }

    public function handleGuardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required'
        ]);
        $comunidad_id = session('comunidad_id');


        $perfil = null;

        if($request->has('id')){
            $perfil = Perfil::find($request->id);
            if(!$perfil){
                //agregar error a parametros
                $parametros['error'] = 'Perfil no encontrada';
                return redirect()->route('perfiles.index')->with($parametros);
            }
        }else{
            $perfil = new Perfil();
        }
        $perfil->nombre = $request->nombre;
        $perfil->descripcion = $request->descripcion;
        $perfil->comunidad_id = $comunidad_id;
        if($request->has('activo')){
            $perfil->activo = 1;
        }else{
            $perfil->activo = 0;
        }
        $perfil->save();


        $parametros['success'] = 'Perfil' . $request->nombre . 'guardado';
        return redirect()->route('perfiles.index')->with($parametros);

    }

    public function eliminar(Request $request)
    {
        $id = $request["id"];
        $perfil = Perfil::find($id);
        if ($perfil) {
            UsuarioComunidad::where('perfil_id', $id)->update(['perfil_id' => null]);
            PermisoPerfil::where('perfil_id', $id)->delete();
            $perfil->delete();
            $parametros['success'] = 'Perfil' . $perfil . 'eliminada';
        } else {
            $parametros['error'] = 'Perfil no encontrada';
        }


        return redirect()->route('perfiles.index')->with($parametros);
    }

}
