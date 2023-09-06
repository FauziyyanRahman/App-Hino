<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class UsersService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url'); // Replace 'services.api.url' with your config key
    }
    public function yajraData($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/yajra/users');
    }
}