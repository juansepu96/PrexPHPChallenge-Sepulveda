<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;


class AuthService{
    public function login($credentials)    {
        if (!Auth::attempt($credentials)) {
            $response = ['message' => 'Error. Verifique las credenciales e intente nuevamente.'];
            LogController::registerLog('login',json_encode($credentials),401,json_encode($response));
            return response()->json($response, 401);
        }

        $user = Auth::user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $token->expires_at = now()->addMinutes(30);
        $token->save();
        $response = [
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => $token->expires_at->toDateTimeString()
        ];
        
        LogController::registerLog('login',json_encode($credentials),200,json_encode($response));

        return response()->json($response);
    }
}