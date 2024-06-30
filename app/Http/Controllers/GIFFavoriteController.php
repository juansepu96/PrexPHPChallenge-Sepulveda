<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GIFFavorite;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Validator;


class GIFFavoriteController extends Controller{
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
    
            $favoriteGif = new GIFFavorite($fullRequest);
    
            $favoriteGif->save();
    
            LogController::registerLog('gif_save_favorite',json_encode($fullRequest),200,json_encode(['message' => 'GIF favorito guardado exitosamente.'], 200));
    
            return response()->json(['message' => 'GIF favorito guardado exitosamente.']);
    
        } catch (\Exception $e) {
            LogController::registerLog('gif_save_favorite',json_encode($fullRequest), 400, json_encode($data));
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
        }        
    }
}
