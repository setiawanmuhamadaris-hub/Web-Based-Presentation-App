<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.webservice.base_url');
    }

    public function login(string $email, string $password): array
    {
        $response = Http::timeout(15)
            ->post("{$this->baseUrl}/login", [
                'email'    => $email,
                'password' => $password,
            ]);

        if ($response->failed()) {
            return ['success' => false, 'message' => 'Kredensial tidak valid.'];
        }

        $data = $response->json();

        $accessToken  = $data['accessToken']  ?? $data['token']        ?? null;
        $refreshToken = $data['refreshToken'] ?? $data['refresh_token'] ?? null;
        $user         = $data['user']         ?? ['email' => $email];

        if (! $accessToken) {
            return ['success' => false, 'message' => 'Token tidak ditemukan dalam response.'];
        }

        Session::put('auth_token',         $accessToken);
        Session::put('auth_refresh_token', $refreshToken);
        Session::put('auth_user',          $user);

        return ['success' => true, 'user' => $user];
    }

    public function logout(): void
    {
        $token = Session::get('auth_token');

        if ($token) {
            Http::timeout(10)
                ->withToken($token)
                ->post("{$this->baseUrl}/logout")
                ->throw();
        }

        Session::forget(['auth_token', 'auth_refresh_token', 'auth_user']);
    }

    public function getToken(): ?string
    {
        return Session::get('auth_token');
    }

    public function getUser(): ?array
    {
        return Session::get('auth_user');
    }

    public function check(): bool
    {
        return Session::has('auth_token');
    }
}