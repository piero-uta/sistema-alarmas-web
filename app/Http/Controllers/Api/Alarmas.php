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
        $avatar = isset($user->avatar) ? $user->avatar : 'https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png';

        return Larafirebase::withTitle($title)
            ->withBody($body)
            ->withImage('https://firebase.google.com/images/social.png')
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
