<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Kutia\Larafirebase\Facades\Larafirebase;

class Alarmas extends Controller
{
    private $deviceTokens = ['djtsQYjMR5SmFg6dooSefy:APA91bHOMmTjLPHBreYGY36P8oAvtryxZB8jg35UST2tvXRws4Mu5T1LVmpGrllnPJ1qSTeG-37UopvnU3NJUsxTsPFcEbjX5kxGy_pq-tA6TmSuKPbzNYhvU0ANwmK3FT-TfB2xhH89'];

    public function sendNotification()
    {

        return Larafirebase::withTitle('Test Title')
            ->withBody('Test body')
            ->withImage('https://firebase.google.com/images/social.png')
            ->withIcon('https://seeklogo.com/images/F/firebase-logo-402F407EE0-seeklogo.com.png')
            ->withSound('notification')
            ->withClickAction('https://www.google.com')
            ->withPriority('high')
            ->withAdditionalData([
                'color' => '#rrggbb',
                'badge' => 0,
            ])
            ->sendNotification($this->deviceTokens);

    }
}
