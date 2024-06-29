<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;



class LogController extends Controller
{
    public static function registerLog($service,$bodyPetition,$code,$bodyResponse)
    {
        $user_id = Auth::user() -> id;
        $ip = $_SERVER['REMOTE_ADDR'];
        $log = new Log([
            'user_id' => $user_id,
            'service' => $service,
            'bodyPetition' => $bodyPetition,
            'code' => $code,
            'bodyResponse' => $bodyResponse,
            'ip' => $ip
        ]);

        $log->save();

    }
}
