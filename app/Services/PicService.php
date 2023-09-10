<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class PicService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url'); // Replace 'services.api.url' with your config key
    }

    public function show($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/web-users');
    }

    public function create($credentials, $data){
        return Http::withToken($credentials)->post($this->apiUrl . '/api/pic', $data);
    }
}