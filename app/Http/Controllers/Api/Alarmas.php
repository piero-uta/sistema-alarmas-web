<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kutia\Larafirebase\Facades\Larafirebase;
use App\Models\User;

class Alarmas extends Controller
{

    public function getDeviceTokens()
    {
        $deviceTokens = User::pluck('token_celular')->toArray();
        $deviceTokensUnique = array_unique($deviceTokens);
        return $deviceTokens;
    }    

    public function sendNotification(Request $request)
    {
        $user = $request->user();
        $title = "$user->nombre $user->apellido_paterno $user->apellido_materno";
        $body = "El usuario $user->nombre esta en emergencia";
        $avatar = isset($user->avatar) ? $user->avatar : 'https://cdn-icons-png.flaticon.com/512/4140/4140060.png';

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
            ->sendNotification($this->getDeviceTokens());

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
