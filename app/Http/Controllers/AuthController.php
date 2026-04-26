<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('refresh_token')) {
            return redirect('/tutorials');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $response = Http::post('https://jwt-auth-eight-neon.vercel.app/login', [
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed() || !$response->json('refreshToken')) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Kredensial tidak valid atau server tidak merespons.']);
        }

        session(['refresh_token' => $response->json('refreshToken')]);

        return redirect('/tutorials');
    }

    public function logout(Request $request)
    {
        $token = session('refresh_token');

        if ($token) {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get('https://jwt-auth-eight-neon.vercel.app/logout');
        }

        $request->session()->forget('refresh_token');
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}