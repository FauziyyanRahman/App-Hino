<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class AuthService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url'); // Replace 'services.api.url' with your config key
    }

    public function authenticate($credentials)
    {
        try {
            $response = Http::timeout(10)->post($this->apiUrl . '/api/login', $credentials);
            
            if (!$response->successful()) {
                Log::error('Authentication failed: ' . $response->status());
                return null;
            }

            $token = $response->json('original.access_token');
            
            if ($token) {
                return JWTAuth::setToken($token);
            }

            Log::error('Authentication failed: Token not found in the API response');
            return null;
        } catch (JWTException $e) {
            Log::error('JWT Exception during authentication: ' . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            Log::error('Exception during authentication: ' . $e->getMessage());
            return null;
        }
    }

    public function me($credentials){
        try {
            $response = Http::withToken($credentials)->get($this->apiUrl . '/api/me');
            
            if (!$response->successful()) {
                Log::error('Authentication failed: ' . $response->status());
                return null;
            }

            $user = $response->json('user_details');
            
            if ($user) {
                return $user;
            }

            Log::error('Authentication failed: User not found in the API response');
            return null;
        } catch (JWTException $e) {
            Log::error('JWT Exception during authentication: ' . $e->getMessage());
            return null;
        } catch (\Exception $e) {
            Log::error('Exception during authentication: ' . $e->getMessage());
            return null;
        }
    }
}
