<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GIFService;
use Illuminate\Support\Facades\Validator;



class GIFController extends Controller{
    private $gifService;

    public function __construct(GIFService $gifService)
    {
        $this->gifService = $gifService;
        $this->apiKey = env('GIPHY_API_KEY');
    }
   
    public function buscarGIFPorQuery(Request $request){
       try {
            $messages = [
                'query.required' => 'Debe enviar un parámetro de búsqueda.',
                'query.string' => 'El parámetro debe ser texto.',
                'limit.numeric' => 'El campo limit tiene que ser numérico.',
                'offset.numeric' => 'El campo offset tiene que ser numérico.',
            ];
    
            $rules = Validator::make($request->all(), [
                'query' => 'required|string',
                'limit' => 'numeric',
                'offset' => 'numeric',
            ],$messages);

            if ($rules->fails()) {
                return response()->json([
                    'message' => $rules->errors(),
                    'code' => 409,
                ], 409);
            }
            $query = $request->input('query');
            $limit = $request->input('limit', 10);
            $offset = $request->input('offset', 0);
            $fullRequest = [
                'query' => [
                    'api_key' => $this->apiKey,
                    'q' => $query,
                    'limit' => $limit,
                    'offset' => $offset
                ]
            ];

            return $this->gifService->buscarGIFPorQuery($fullRequest);
    
       } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
            LogController::registerLog('gif_search',json_encode($fullRequest), 400, json_encode($data));
        }
    }

    public function buscarGIFPorID($id){
        try {
            return $this->gifService->buscarGIFPorID($id,$this->apiKey);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
            LogController::registerLog('gif_get_by_id', $id, 400, json_encode($data));
        }
    }
}
