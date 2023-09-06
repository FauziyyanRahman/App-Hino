<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class HomeService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url'); // Replace 'services.api.url' with your config key
    }
    public function requestData($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/visitors');
    }

    public function yajraData($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/yajra');
    }

    public function approvalData($credentials, $rowId, $status, $reject){
        // Define the JSON payload
        $payload = [
            'id' => $rowId,
            'status' => $status,
            'reject' => $reject,
        ];

        // Send the POST request with the Bearer token
        $response = Http::withToken($credentials)
                        ->withHeaders([
                            'Content-Type' => 'application/json',
                        ])
                        ->post($this->apiUrl . '/api/add-respond', $payload);

        Log::info($response);               

        // You can return the response or decode it as JSON and return
        return $response->json();
    }
}
