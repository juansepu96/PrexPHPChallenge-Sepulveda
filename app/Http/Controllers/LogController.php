<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;



class LogController extends Controller
{
    public static function registerLog($service,$bodyPetition,$code,$bodyResponse)
    {

        $user_id = Auth::user() ?  Auth::user() -> id  : 0;

        $ip = isset($_SERVER['REMOTE_ADDR']) ?  $_SERVER['REMOTE_ADDR']  : 0;

        if(Auth::user()){
            $user_id = Auth::user() -> id;
        }else{
            $user_id = 0;
        }

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
