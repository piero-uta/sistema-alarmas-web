<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\User;
use App\Models\UsuarioComunidad;
use Illuminate\Support\Facades\DB;
use App\Models\Comunidad;
use App\Models\Direccion;
use App\Models\Alarma;
use App\Models\Chequeo;

class Alarmas extends Controller
{
    public function getAlarms(Request $request)
    {
        $comunidad_id = $request['comunidad_id'];
       $alarmas = Alarma::join('direcciones', 'alarmas.direccion_id', '=', 'direcciones.id')
        ->join('comunidades', 'comunidades.id', '=', 'direcciones.comunidad_id')
        ->where('comunidades.id', $comunidad_id)
        ->select('alarmas.*') //, 'direcciones.*', 'comunidades.*'
        ->get()
        ->toArray();

        return $alarmas;
    }

    public function getDeviceTokensMobile($user, $comunidad_id)
    {
        $tokens = DB::table('usuarios_comunidad AS uc1')
        ->select('u2.token_celular')
        ->distinct()
        ->join('redes_avisos', 'uc1.direccion_id', '=', 'redes_avisos.direccion_id')
        ->join('usuarios_comunidad AS uc2', 'uc2.direccion_id', '=', 'redes_avisos.direccion_vecino_id')
        ->join('users AS u2', 'u2.id', '=', 'uc2.usuario_id')
        ->where('uc1.comunidad_id', $comunidad_id)
        ->where('uc1.usuario_id', $user->id)
        ->pluck('u2.token_celular')
        ->toArray();

        $usuarioComunidad = UsuarioComunidad::where('comunidad_id',$comunidad_id)
        ->where('usuario_id', $user->id)
        ->first();
        $direccion = Direccion::where('id', $usuarioComunidad->direccion_id)->first();

        $tokens_mi_direccion = DB::table('usuarios_comunidad as uc')
        ->select('u.token_celular')
        ->join('users as u', 'uc.usuario_id', '=', 'u.id')
        ->where('uc.direccion_id', $direccion->id)
        ->pluck('u.token_celular')
        ->toArray();

        $tokens_total = array_merge($tokens, $tokens_mi_direccion);

        $tokensFiltrados = array_filter($tokens_total, function($value) {
            return $value !== null;
        });

        $finalTokens = array_unique($tokensFiltrados);
        return array_values($finalTokens);
    }

    public function getDeviceTokensWeb($user, $comunidad_id)
    {
        $tokens = DB::table('usuarios_comunidad AS uc1')
        ->select('u2.token_web')
        ->distinct()
        ->join('redes_avisos', 'uc1.direccion_id', '=', 'redes_avisos.direccion_id')
        ->join('usuarios_comunidad AS uc2', 'uc2.direccion_id', '=', 'redes_avisos.direccion_vecino_id')
        ->join('users AS u2', 'u2.id', '=', 'uc2.usuario_id')
        ->where('uc1.comunidad_id', $comunidad_id)
        ->where('uc1.usuario_id', $user->id)
        ->pluck('u2.token_web')
        ->toArray();

        $usuarioComunidad = UsuarioComunidad::where('comunidad_id',$comunidad_id)
        ->where('usuario_id', $user->id)
        ->first();
        $direccion = Direccion::where('id', $usuarioComunidad->direccion_id)->first();

        $tokens_mi_direccion = DB::table('usuarios_comunidad as uc')
        ->select('u.token_web')
        ->join('users as u', 'uc.usuario_id', '=', 'u.id')
        ->where('uc.direccion_id', $direccion->id)
        ->pluck('u.token_web')
        ->toArray();

        $tokens_total = array_merge($tokens, $tokens_mi_direccion);

        $tokensFiltrados = array_filter($tokens_total, function($value) {
            return $value !== null;
        });

        $finalTokens = array_unique($tokensFiltrados);
        return array_values($finalTokens);
    }

    public function sendNotification(Request $request)
    {
        $user = $request->user();
        $comunidad_id = $request['comunidad_id'];
        $comunidad = Comunidad::where('id', $comunidad_id)->first();

        $usuarioComunidad = UsuarioComunidad::where('comunidad_id',$comunidad_id)
        ->where('usuario_id', $user->id)
        ->first();
        $direccion = Direccion::where('id', $usuarioComunidad->direccion_id)->first();


        $title = "$user->nombre $user->apellido_paterno $user->apellido_materno";
        $body = "El usuario $user->nombre esta en emergencia";
        $avatar = isset($user->avatar) ? $user->avatar : 'https://cdn-icons-png.flaticon.com/512/4140/4140060.png';

        $tokens_mobile = $this->getDeviceTokensMobile($user, $comunidad_id);
        $tokens_web = $this->getDeviceTokensWeb($user, $comunidad_id);

        $tokens = array_merge($tokens_mobile, $tokens_web);

        date_default_timezone_set('America/Santiago');
        $fecha = strftime('Fecha %d-%m-%Y');
        $hora = strftime('%H:%M Horas');
        $fecha_sql = date('Y-m-d');
        $hora_sql = date('H:i:s');

        if(empty($tokens)){
            return "No se pueden enviar notificaciones, no hay tokens disponibles.";
        }else{
            $alarma = new Alarma;
            $alarma->direccion_id = $direccion->id;
            $alarma->fecha = $fecha_sql;
            $alarma->hora = $hora_sql;
            $alarma->nombre_usuario = $user->nombre;
            $alarma->codigo = $direccion->codigo;
      
            /// Crear los datos de chequeos
            $chequeo = new Chequeo;
            $chequeo->alarma_id = $alarma->id;
            $chequeo->fecha = '';
            $chequeo->hora = '';
            $chequeo->usuario_chequeo = null;
            $chequeo->estado_chequeo = 0;
            $chequeo->vecino_chequeo = $alarma->nombre_usuario;
            $chequeo->observacion = '';
            $chequeo->tipo_chequeo = null;
            $chequeo->tipo_evento = null;    

            $alarma->save();
            $chequeo->save();

            return Larafirebase::withTitle($title)
            ->withBody($body)
            ->withImage('https://img.freepik.com/vector-gratis/senal-advertencia-triangulo-rojo-ilustracion-arte-vectorial_56104-865.jpg?w=740&t=st=1695986238~exp=1695986838~hmac=e4584b1d466880abfdd0ff55f35ca1150b61a04a48cad577ea888fdf4ef02e8c')
            ->withIcon($avatar)
            ->withSound('notification.ogg')
            ->withClickAction('FLUTTER_NOTIFICATION_CLICK')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
                'id' => $alarma->id,
                'fecha' => $fecha,
                'hora' => $hora,
                'titulo' => $comunidad->razon_social,
                'direccion' => 'Calle: '.$direccion->calle.' '.$direccion->numero.', piso'.$direccion->piso,
                'direccion_cod' => 'Codigo: '.$direccion->codigo,
                'latitud' => $direccion->latitud,
                'longitud' => $direccion->longitud,
                'nombre' => 'De '.$user->nombre,
                'logo' => $comunidad->logo
            ])
            ->sendNotification($tokens);
        }
    }

    public function getComunities(Request $request)
    {
        $user = $request->user();
        return $user;
    }


    public function saveFCMToken(Request $request)
    {
        try {
            $request->user()->update(['token_celular'=>$request->token]);
            return response()->json([
                'success' => true
            ]);
        } catch (\Exception $e) {
            report($e);
            return response()->json([
                'success'=>false
            ],500);
        }
    }
}
