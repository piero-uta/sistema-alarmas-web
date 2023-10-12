<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\User;
use App\Models\UsuarioComunidad;
use Illuminate\Support\Facades\DB;


class Alarmas extends Controller
{

    public function getDeviceTokens($user, $comunidad_id)
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
        $tokensFiltrados = array_filter($tokens, function($token){
            return !empty($token);
        });
        $finalTokens = array_unique($tokensFiltrados);
        return $finalTokens;
    }

    public function sendNotification(Request $request)
    {
        $user = $request->user();
        $comunidad_id = $request['comunidad_id'];

        $title = "$user->nombre $user->apellido_paterno $user->apellido_materno";
        $body = "El usuario $user->nombre esta en emergencia";
        $avatar = isset($user->avatar) ? $user->avatar : 'https://cdn-icons-png.flaticon.com/512/4140/4140060.png';

        $tokens = $this->getDeviceTokens($user, $comunidad_id);

        if(empty($tokens)){
            return "No se pueden enviar notificaciones, no hay tokens disponibles.";
        }else{
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
            ])
            ->sendNotification($tokens);
        }
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
