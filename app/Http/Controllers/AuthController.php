<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\LogController;



class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        // Utilizar el guard predeterminado de Laravel para intentar autenticar al usuario
        if (!Auth::attempt($credentials)) {
            return response()->json(['message' => 'Error. Verifique las credenciales e intente nuevamente.'], 401);
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
        
        LogController::registerLog('login',$request,200,json_encode($response));

        return response()->json($response);
    }

    
}
