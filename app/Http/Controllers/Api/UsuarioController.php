<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            $usuarios = Usuario::all();

            $resultados = $usuarios->map(function ($usuario) {
                return [
                    'id' => $usuario->id,
                    'usuario_nome' => $usuario->usuario_nome,
                    'empresa_id' => $usuario->empresa_id,
                    'email' => $usuario->email,
                ];
            });

            return response()->json($resultados);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar usuarios: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao buscar usuarios.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'usuario_nome' => 'required|string|max:255',
                'empresa_id' => 'required|exists:empresas,id',
                'email' => 'required|email|max:255',
                'password' => 'required|string|min:8',
            ]);

            return Usuario::create($request->all());

            return response()->json(['message' => 'Usuário cadastrado com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar usuário: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao cadastrar usuário.'], 500);
        }
    }

    public function show(Usuario $usuario)
    {
        try {
            $usuario->load('empresa');

            return response()->json([
                'id' => $usuario->id,
                'usuario_nome' => $usuario->usuario_nome,
                'email' => $usuario->email
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao retornar usuário: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao retornar usuário:'], 500);
        }
    }

    public function update(Request $request, Usuario $usuario)
    {
        try {
            $request->validate([
                'usuario_nome' => 'sometimes|required|string|max:255',
                'empresa_id' => 'sometimes|required|exists:empresas,id',
                'email' => 'required|email|max:255',
            ]);

            $usuario->update($request->all());

            return response()->json(['message' => 'Usuário atualizado com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar usuário: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar usuário:'], 500);
        }
    }

    public function destroy(Usuario $usuario)
    {
        try {
            $usuario->delete();

            return response()->json(['message' => 'Usuário removido com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao remover usuário: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao remover usuário:'], 500);
        }
    }
}
