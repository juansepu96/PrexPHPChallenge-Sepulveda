<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller{
    public function login(Request $request){
        $messages = [
            'email.required' => 'El campo de correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'password.required' => 'El campo de contraseña es obligatorio.',
            'password.string' => 'La contraseña debe texto.',
        ];

        $rules = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ],$messages);

        if ($rules->fails()) {
            return response()->json([
                'message' => $rules->errors(),
            ], 409);
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            $response = ['message' => 'Error. Verifique las credenciales e intente nuevamente.'];
            LogController::registerLog('login',$request,401,json_encode($response));
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
        
        LogController::registerLog('login',$request,200,json_encode($response));

        return response()->json($response);
    }    
}
