<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\LogController;
use Illuminate\Support\Facades\Validator;

class GIFController extends Controller{
    protected $client;
    protected $apiKey;

    public function __construct(){
        $this->client = new Client();
        $this->apiKey = env('GIPHY_API_KEY');
    }

    public function search(Request $request){
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


            $url = "https://api.giphy.com/v1/gifs/search?api_key=";
            $response = $this->client->request('GET', $url,$fullRequest);
    
            $data = json_decode($response->getBody(), true);
    
            LogController::registerLog('gif_search', json_encode($fullRequest), $response->getStatusCode(), json_encode($data));
    
            if ($data['meta']["status"] == 200) {
                return response()->json($data);
            } else {
                return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
            }
    
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
            LogController::registerLog('gif_search',json_encode($fullRequest), 400, json_encode($data));
        }
    }

    public function getById($id){
        try {
            $url = "http://api.giphy.com/v1/gifs/{$id}?api_key={$this->apiKey}";

            $response = $this->client->request('GET', $url);

            $data = json_decode($response->getBody(), true);

            LogController::registerLog('gif_get_by_id', $id, $response->getStatusCode(), json_encode($data));

            return response()->json($data);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al obtener los datos de Giphy'], 400);
            LogController::registerLog('gif_get_by_id', $id, 400, json_encode($data));
        }
    }
}
