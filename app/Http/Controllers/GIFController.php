<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Controllers\LogController;


class GIFController extends Controller
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = env('GIPHY_API_KEY');
    }

     public function search(Request $request)
    {
        $request->validate([
            'query' => 'required|string',
            'limit' => 'integer',
            'offset' => 'integer',
        ]);

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

        $response = $this->client->get("http://api.giphy.com/v1/gifs/search", $fullRequest);

        $data = json_decode($response->getBody(), true);

        LogController::registerLog('gif_search',json_encode($fullRequest),200,json_encode($data));

        return response()->json($data);
    }

    public function getById($id)
    {
        $fullRequest = [
            'query' => [
                    'api_key' => $this->apiKey,
                    'id_gif' => $id,
            ]
        ];

        $response = $this->client->get("http://api.giphy.com/v1/gifs/{$id}", $fullRequest);

        $data = json_decode($response->getBody(), true);

        LogController::registerLog('gif_get_by_id',json_encode($fullRequest),200,json_encode($data));


        return response()->json($data);
    }

}
