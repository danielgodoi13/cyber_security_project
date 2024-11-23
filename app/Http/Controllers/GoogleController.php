<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redireciona o usuário para o Google para autenticação.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Manipula o callback do Google após autenticação.
     */
    public function handleGoogleCallback()
    {
        try {
            // Obtem as informações do usuário no Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Procura o usuário pelo e-mail no banco de dados
            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                // Cria um novo usuário se não existir
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'password' => Hash::make(uniqid()), // Cria uma senha aleatória
                    'role' => 'user', // Define um role padrão, ajuste se necessário
                ]);
            }

            // Gera um token JWT para o usuário
            $token = JWTAuth::fromUser($user);

            // Retorna a resposta com o token e os dados do usuário
            return response()->json([
                'message' => 'Login/Register successful',
                'user' => $user,
                'token' => $token, // Inclui o token na resposta
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Authentication failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
