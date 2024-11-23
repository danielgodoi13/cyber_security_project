<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Método para obter os dados do usuário autenticado
     */
    public function getUser()
    {
        try {
            // Obtém o usuário autenticado
            $user = auth()->user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401); // Unauthorized
            }

            return response()->json($user, 200);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401); // Token inválido
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to validate token'], 500); // Token ausente ou erro interno
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve user data',
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Método para listar todos os usuários - apenas para admin
     */
    public function getAllUsers()
    {
        try {
            // Obtém o usuário autenticado
            $user = auth()->user();

            if (!$user) {
                return response()->json(['error' => 'User not authenticated'], 401); // Unauthorized
            }

            // Verifica se o usuário atual tem permissão de admin
            if (Gate::denies('is-admin')) {
                return response()->json(['error' => 'Unauthorized'], 403); // Forbidden
            }

            // Retorna todos os usuários
            $users = User::all();
            return response()->json($users, 200);
        } catch (TokenInvalidException $e) {
            return response()->json(['error' => 'Invalid token'], 401); // Token inválido
        } catch (JWTException $e) {
            return response()->json(['error' => 'Failed to validate token'], 500); // Token ausente ou erro interno
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to retrieve users',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
