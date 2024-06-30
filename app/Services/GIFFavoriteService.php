<?php


namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use App\Models\GIFFavorite;


class GIFFavoriteService{
    public function guardarGIFFavorito($fullRequest){
        $favoriteGif = new GIFFavorite($fullRequest);    
        $favoriteGif->save();
        LogController::registerLog('gif_save_favorite',json_encode($fullRequest),200,json_encode(['message' => 'GIF favorito guardado exitosamente.'], 200));
        return response()->json(['message' => 'GIF favorito guardado exitosamente.']);
    }
}