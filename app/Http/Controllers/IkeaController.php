<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class IkeaController extends Controller
{
    public function search(Request $request)
{
    $keyword = $request->query('q', 'chair');

    try {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('GET', 'https://ikea-api.p.rapidapi.com/keywordSearch', [
            'query' => [
                'keyword' => $keyword,
                'countryCode' => 'us',
                'languageCode' => 'en',
            ],
            'headers' => [
                'x-rapidapi-host' => 'ikea-api.p.rapidapi.com',
                'x-rapidapi-key' => env('RAPIDAPI_KEY'),
            ]
        ]);

        $data = json_decode($response->getBody(), true);

        // 🔍 Log full structure to storage/logs/laravel.log
        \Log::info("IKEA API Response", $data);

        return response()->json(array_slice($data, 0, 10));
    } catch (\Exception $e) {
        \Log::error('IKEA API Error: ' . $e->getMessage());
        return response()->json([
            'error' => 'Failed to fetch data from IKEA API',
            'message' => $e->getMessage()
        ], 500);
    }
}

}
