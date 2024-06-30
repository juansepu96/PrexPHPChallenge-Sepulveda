<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\GIFFavoriteService;


class GIFFavoriteController extends Controller{
    private $gifFavoriteService;

    public function __construct(GIFFavoriteService $gifFavoriteService)
    {
        $this->gifFavoriteService = $gifFavoriteService;
        $this->apiKey = env('GIPHY_API_KEY');
    }
    public function guardarGIFFavorito(Request $request){
        try {
            $messages = [
                'gif_id.required' => 'Debe enviar el ID del GIF.',
                'gif_id.string' => 'El ID debe ser del tipo texto.',
                'alias.required' => 'El alias es requerido.',
                'alias.string' => 'El alias debe ser texto.',
                'user_id.required' => 'El ID de Usuario es obligatorio.',
                'user_id.numeric' => 'El ID de Usuario tiene que ser numérico.',
            ];
    
            $rules = Validator::make($request->all(), [
                'gif_id' => 'required|string',
                'alias' => 'required|string',
                'user_id' => 'required|numeric',
            ],$messages);
    
            if ($rules->fails()) {
                return response()->json([
                    'message' => $rules->errors(),
                ], 409);
            }
    
            $fullRequest = [
                'gif_id' => $request->input('gif_id'),
                'alias' => $request->input('alias'),
                'user_id' => $request->input('user_id'),
            ];
            return $this->gifFavoriteService->guardarGIFFavorito($fullRequest);           
    
        } catch (\Exception $e) {
            LogController::registerLog('gif_save_favorite',json_encode($fullRequest), 400, json_encode($data));
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
        }        
    }
}
