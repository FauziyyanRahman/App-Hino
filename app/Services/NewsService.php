<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
use Mockery\Undefined;

class NewsService
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.api.url'); // Replace 'services.api.url' with your config key
    }

    public function get($credentials, $id){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/id-berita/' . $id);
    }

    public function create($credentials, $data){
        if(isset($data['berita_foto'])){
            return Http::withToken($credentials)->attach(
                'berita_foto', file_get_contents($data['berita_foto']), $data['berita_foto']->getClientOriginalName()
            )->post($this->apiUrl . '/api/add-berita', $data);
        } else {
            return Http::withToken($credentials)->post($this->apiUrl . '/api/add-berita', $data);
        }
    }

    public function update($credentials, $data){
        if(isset($data['ubah_berita_foto'])){
            return Http::withToken($credentials)->attach(
                'ubah_berita_foto', file_get_contents($data['ubah_berita_foto']), $data['ubah_berita_foto']->getClientOriginalName()
            )->post($this->apiUrl . '/api/update-berita', $data);
        } else {
            return Http::withToken($credentials)->post($this->apiUrl . '/api/update-berita', $data);
        }
    }

    public function delete($credentials, $data){
        return Http::withToken($credentials)->delete($this->apiUrl . '/api/delete-berita/' . $data['id']);
    }

    public function yajraData($credentials){
        return Http::withToken($credentials)->get($this->apiUrl . '/api/data-berita');
    }
}