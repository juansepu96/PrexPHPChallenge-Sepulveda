<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GIFFavorite;
use App\Http\Controllers\LogController;

class GIFFavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'gif_id' => 'required|string',
            'alias' => 'required|string',
            'user_id' => 'required|numeric',
        ]);

        $fullRequest = [
            'gif_id' => $request->input('gif_id'),
            'alias' => $request->input('alias'),
            'user_id' => $request->input('user_id'),
        ];

        $favoriteGif = new GIFFavorite($fullRequest);

        $favoriteGif->save();

        LogController::registerLog('gif_save_favorite',json_encode($fullRequest),200,json_encode(['message' => 'GIF favorito guardado exitosamente',"code" => 200], 200));


        return response()->json(['message' => 'GIF favorito guardado exitosamente'], 200);
    }
}
