<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\AuthService;

class AuthController extends Controller{
    private $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }
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

        return $this->authService->login($credentials);

    }    
}
