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
use Illuminate\Support\Facades\DB;


class AsignacionPerfiles extends Controller
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
    public function index(Request $request)
    {

        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::find($comunidad_id);

        $perfiles_comunidad = Perfil::where('comunidad_id',$comunidad_id)
        ->get();


        $perfil_aux = $perfiles_comunidad->first()->id;

        $perfiles = UsuarioComunidad::select('perfiles.*')
        ->join('comunidades', 'comunidades.id', '=', 'usuarios_comunidad.comunidad_id')
        ->join('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
        ->where('comunidades.id', $comunidad_id)
        ->distinct()
        ->get();


        $permisos_perfil = DB::table('permisos')
        ->select('permisos.nombre')
        ->join('permisos_perfil', 'permisos.id', '=', 'permisos_perfil.permiso_id')
        ->join('perfiles', 'permisos_perfil.perfil_id', '=', 'perfiles.id')
        ->join('comunidades', 'perfiles.comunidad_id', '=', 'comunidades.id')
        ->where('comunidades.id', $comunidad_id)
        ->where('perfiles.id', $perfil_aux)
        ->distinct();

        $opciones = ['DashboardMonitoreo', 'BotonAlarma', 'Comunidad','DireccionesUsuario','Usuarios','AsignacionPerfiles','Perfiles','RedAviso'];

        $comunidad_permisos = $permisos_perfil
        ->select(DB::raw("SUBSTRING_INDEX(permisos.nombre, '-', 1) as opcion, GROUP_CONCAT(SUBSTRING_INDEX(permisos.nombre, '-', -1) SEPARATOR '-') as acciones_concatenadas"))
        ->groupBy('opcion')
        ->get()
        ->toArray();

        $todasLasOpciones = [];
        foreach ($opciones as $opcion) {
            $opcionEncontrada = false;
            foreach ($comunidad_permisos as $permiso) {
                if ($permiso->opcion === $opcion) { // Utiliza -> en lugar de []
                    $todasLasOpciones[] = [
                        'opcion' => $permiso->opcion,
                        'acciones_concatenadas' => $permiso->acciones_concatenadas,
                    ];
                    $opcionEncontrada = true;
                    break;
                }
            }
            if (!$opcionEncontrada) {
                $todasLasOpciones[] = [
                    'opcion' => $opcion,
                    'acciones_concatenadas' => '',
                ];
            }
        }

        $permisos = $this->getPermisos($comunidad);

        if(in_array('AsignacionPerfiles-c', $permisos)||
        in_array('AsignacionPerfiles-r', $permisos)||
        in_array('AsignacionPerfiles-u', $permisos)||
        in_array('AsignacionPerfiles-d', $permisos)){
        return view('asignacionPerfiles.index', compact('todasLasOpciones','permisos','perfiles_comunidad','perfil_aux'));
        }else{
            return view('main-dashboard');
            // return redirect()->route('login');
        }


    }
    public function seleccionar(Request $request, $id)
    {
        $perfil_aux = $id;
        $comunidad_id = Session::get('comunidad_id');
        $comunidad = Comunidad::find($comunidad_id);

        $perfiles_comunidad = Perfil::where('comunidad_id',$comunidad_id)
        ->get();



        $perfiles = UsuarioComunidad::select('perfiles.*')
        ->join('comunidades', 'comunidades.id', '=', 'usuarios_comunidad.comunidad_id')
        ->join('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
        ->where('comunidades.id', $comunidad_id)
        ->distinct()
        ->get();


        $permisos_perfil = DB::table('permisos')
        ->select('permisos.nombre')
        ->join('permisos_perfil', 'permisos.id', '=', 'permisos_perfil.permiso_id')
        ->join('perfiles', 'permisos_perfil.perfil_id', '=', 'perfiles.id')
        ->join('comunidades', 'perfiles.comunidad_id', '=', 'comunidades.id')
        ->where('comunidades.id', $comunidad_id)
        ->where('perfiles.id', $id)
        ->distinct();
        // $acciones = ['c', 'r', 'u','d'];


        $opciones = ['DashboardMonitoreo', 'BotonAlarma', 'Comunidad','DireccionesUsuario','Usuarios','AsignacionPerfiles','Perfiles','RedAviso'];

        $comunidad_permisos = $permisos_perfil
        ->select(DB::raw("SUBSTRING_INDEX(permisos.nombre, '-', 1) as opcion, GROUP_CONCAT(SUBSTRING_INDEX(permisos.nombre, '-', -1) SEPARATOR '-') as acciones_concatenadas"))
        ->groupBy('opcion')
        ->get()
        ->toArray();

        $todasLasOpciones = [];
        foreach ($opciones as $opcion) {
            $opcionEncontrada = false;
            foreach ($comunidad_permisos as $permiso) {
                if ($permiso->opcion === $opcion) { // Utiliza -> en lugar de []
                    $todasLasOpciones[] = [
                        'opcion' => $permiso->opcion,
                        'acciones_concatenadas' => $permiso->acciones_concatenadas,
                    ];
                    $opcionEncontrada = true;
                    break;
                }
            }
            if (!$opcionEncontrada) {
                $todasLasOpciones[] = [
                    'opcion' => $opcion,
                    'acciones_concatenadas' => '',
                ];
            }
        }

        // if ($comunidad_permisos->isEmpty()) {
        //     return redirect()->route('asignacionPerfiles.index');
        // }


        $permisos = $this->getPermisos($comunidad);


        if(in_array('AsignacionPerfiles-c', $permisos)||
        in_array('AsignacionPerfiles-r', $permisos)||
        in_array('AsignacionPerfiles-u', $permisos)||
        in_array('AsignacionPerfiles-d', $permisos)){
        return view('asignacionPerfiles.index', compact('todasLasOpciones','permisos','perfiles_comunidad','perfil_aux'));
        }else{
            return view('main-dashboard');
            // return redirect()->route('login');
        }


    }

    public function onCheckedPermiso(Request $request)
    {
        $checkbox = $request["checkboxName"];
        $parts = explode("-", $checkbox,2);
        $isChecked = $request["isChecked"];
        if($isChecked == 'true'){
            $permiso_actual = Permiso::where('nombre', $parts[1])->first();
            $permisoPerfil = new PermisoPerfil();
            $permisoPerfil->permiso_id = $permiso_actual->id;
            $permisoPerfil->perfil_id = intval($parts[0]);
            $permisoPerfil->save();
            return response()->json(['permisoPerfil' => $permisoPerfil]);
        }
        else{
            $permiso = Permiso::where('nombre', $parts[1])
                   ->first();
            $result = DB::table('permisos_perfil')
            ->where('permiso_id', $permiso->id)
            ->where('perfil_id', intval($parts[0]))
            ->delete();
            return response()->json(['result' => $result, 'permiso_id'=>$permiso->id, 'perfil_id'=>intval($parts[0])]);
            // return response()->json(['permiso_id' => $permiso->id, 'perfil_id'=> $parts[0]]);
        }

    }

    // public function formularioGuardar(Request $request)
    // {
    //     $parametros = [];
    //     $comunidad_id = Session::get('comunidad_id');
    //     if($request->has('id')){
    //         // $usuario = User::find($request->id);

    //         $usuario = User::select('users.*', 'perfiles.id as perfil_id')
    //             ->join('usuarios_comunidad', 'users.id', '=', 'usuarios_comunidad.usuario_id')
    //             ->join('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
    //             ->where('usuario_comunidad.comunidad_id', $comunidad_id)
    //             ->where('users.id', $request->id)
    //             ->first();

    //         if(!$usuario){
    //             //agregar error a parametros
    //             $parametros['error'] = 'Usaurio no encontrada';
    //             return redirect()->route('usuarios.index')->with($parametros);
    //         }
    //         $parametros['usuario'] = $usuario;
    //         $parametros['direccion_id'] = $usuario->direccionIdComunidad($comunidad_id);
    //         $parametros['perfil_id'] = $usuario->perfil_id;

    //     }

    //     // obtener direcciones
    //     $direcciones = Direccion::where('comunidad_id', $comunidad_id)->get();

    //     $perfiles = UsuarioComunidad::select('perfiles.*')
    //     ->join('comunidades', 'comunidades.id', '=', 'usuarios_comunidad.comunidad_id')
    //     ->join('perfiles', 'perfiles.id', '=', 'usuarios_comunidad.perfil_id')
    //     ->where('comunidades.id', $comunidad_id)
    //     ->distinct()
    //     ->get();

    //     $parametros['direcciones'] = $direcciones;
    //     $parametros['perfiles'] = $perfiles;
    //     return view('usuarios.guardar', $parametros);
    // }

    // public function handleGuardar(Request $request)
    // {
    //     $request->validate([
    //         'nombre' => 'required',
    //         'apellido_paterno' => 'required',
    //         'apellido_materno' => 'required',
    //         'email' => 'required',
    //         'password' => 'required',
    //     ]);

    //     $usuarioComunidad = null;

    //     if($request->has('id')){
    //         $usuario = User::find($request->id);
    //         if(!$usuario){
    //             //agregar error a parametros
    //             $parametros['error'] = 'Usaurio no encontrada';
    //             return redirect()->route('usuarios.index')->with($parametros);
    //         }
    //         $usuarioComunidad = UsuarioComunidad::where('usuario_id', $usuario->id)->where('comunidad_id', Session::get('comunidad_id'))->first();
    //     }else{
    //         $usuario = new User();
    //         $usuarioComunidad = new UsuarioComunidad();
    //     }
    //     $usuario->nombre = $request->nombre;
    //     $usuario->apellido_paterno = $request->apellido_paterno;
    //     $usuario->apellido_materno = $request->apellido_materno;
    //     $usuario->email = $request->email;
    //     $usuario->password = $request->password;
    //     if($request->has('activo')){
    //         $usuario->activo = 1;
    //     }else{
    //         $usuario->activo = 0;
    //     }
    //     $usuario->save();

    //     // Obtener comunidad_id de session
    //     $usuarioComunidad->usuario_id = $usuario->id;
    //     $usuarioComunidad->perfil_id = $request->perfil_id;
    //     $usuarioComunidad->direccion_id = $request->direccion_id;

    //     if($usuarioComunidad->comunidad_id == null)
    //     {
    //         $usuarioComunidad->comunidad_id = Session::get('comunidad_id');
    //     }
    //     $usuarioComunidad->save();

    //     $parametros['success'] = 'Usuario' . $request->nombre . 'guardado';
    //     return redirect()->route('usuarios.index')->with($parametros);

    // }

    // public function eliminar(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required',
    //     ]);
    //     $usuario = User::find($request->id);
    //     if(!$usuario){
    //         //agregar error a parametros
    //         $parametros['error'] = 'Usuario no encontrada';
    //         return redirect()->route('usuarios.index')->with($parametros);
    //     }
    //     $nombre = $usuario->nombre;
    //     // buscar usuarioComunidad
    //     $usuarioComunidad = UsuarioComunidad::where('usuario_id', $usuario->id)->where('comunidad_id', Session::get('comunidad_id'))->first();
    //     if($usuarioComunidad){
    //         $usuarioComunidad->delete();
    //     }
    //     //success
    //     $parametros['success'] = 'Usuario' . $nombre . 'eliminada';
    //     return redirect()->route('usuarios.index')->with($parametros);
    // }

}
