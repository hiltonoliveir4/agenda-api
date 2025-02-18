<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService
{
    public function login(array $credentials): JsonResponse
    {
        try {
            if (!Auth::attempt($credentials)) {
                return response()->json(['error' => 'Credenciais inválidas'], 401);
            }

            $user = Auth::user();
            $token = $user->createToken('auth_token')->accessToken;

            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao fazer login', 'message' => $e->getMessage()], 500);
        }
    }

    public function register(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
            ]);

            Auth::login($user);
            $token = $user->createToken('auth_token')->accessToken;

            DB::commit();

            return response()->json([
                'user' => $user,
                'access_token' => $token,
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Erro ao fazer registro', 'message' => $e->getMessage()], 500);
        }
    }

    public function logout(User $user): JsonResponse
    {
        try {
            $user->token()->revoke();

            return response()->json(['message' => 'Logout realizado com sucesso.'], 200);
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao fazer logout', 'message' => $e->getMessage()], 500);
        }
    }
}
