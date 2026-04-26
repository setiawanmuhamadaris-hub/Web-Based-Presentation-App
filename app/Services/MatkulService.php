<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;

class MatkulService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.webservice.base_url');
    }

    public function getAll(): array
    {
        return Cache::remember('matkul_list', 300, function () {
            $token = Session::get('auth_token');

            $response = Http::timeout(15)
                ->withToken($token)
                ->get("{$this->baseUrl}/getMakul");

            if ($response->failed()) {
                return [];
            }

            $data = $response->json();

            return $data['data'] ?? $data ?? [];
        });
    }
}