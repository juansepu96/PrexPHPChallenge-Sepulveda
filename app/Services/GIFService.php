<?php


namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LogController;
use GuzzleHttp\Client;


class GIFService{

    protected $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function buscarGIFPorQuery($fullRequest){
        $url = "https://api.giphy.com/v1/gifs/search?api_key=";
        $response = $this->client->request('GET', $url,$fullRequest);
        $data = json_decode($response->getBody(), true);
        LogController::registerLog('gif_search', json_encode($fullRequest), $response->getStatusCode(), json_encode($data));
        return response()->json($data);
    }

    public function buscarGIFPorID($id,$apiKey){
        $url = "http://api.giphy.com/v1/gifs/{$id}?api_key={$apiKey}";
        $response = $this->client->request('GET', $url);
        $data = json_decode($response->getBody(), true);
        LogController::registerLog('gif_get_by_id', $id, $response->getStatusCode(), json_encode($data));
        return response()->json($data);
    }    
}