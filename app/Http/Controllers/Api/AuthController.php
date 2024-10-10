<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except(['login']);
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|string',
            ]);

            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                $user = Auth::user();

                $token = $user->createToken('AppToken')->plainTextToken;

                return response()->json(['token' => $token], 200);
            }
            return response()->json(['message' => 'These credentials do not match our records.'], 401);
        } catch (\Exception $e) {
            Log::error('Erro no login: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao tentar realizar o login.'], 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();

            return response()->json(['message' => 'Você foi deslogado com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao deslogar: ' . $e->getMessage());
            return response()->json(['error' => 'Ocorreu um erro ao tentar deslogar.'], 500);
        }
    }
}
