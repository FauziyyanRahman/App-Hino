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

    public function create($credentials, $data){
        return Http::withToken($credentials)->post($this->apiUrl . '/api/users', $data);
    }

    public function update($credentials, $id, $data){
        return Http::withToken($credentials)->put($this->apiUrl . '/api/users/' . $id, $data);
    }

    public function delete($credentials, $data){
        return Http::withToken($credentials)->delete($this->apiUrl . '/api/users/' . $data['id'] . '/' . $data['deletedBy']);
    }

    public function yajraData($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/yajra/users');
    }
}