<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClienteController extends Controller
{
    public function index()
    {
        try {
            $clientes = Cliente::with('usuario.empresa')->get();

            $resultados = $clientes->map(function ($cliente) {
                return [
                    'id' => $cliente->id,
                    'cliente_nome' => $cliente->cliente_nome,
                    'usuario_nome' => $cliente->usuario ? $cliente->usuario->usuario_nome : null,
                    'empresa_nome' => $cliente->usuario->empresa->empresa_nome,
                ];
            });

            return response()->json($resultados);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar clientes: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao buscar clientes.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                'cliente_nome' => 'required|string|max:255',
                'usuario_id' => 'required|exists:usuarios,id',
            ]);

            Cliente::create($request->all());

            return response()->json(['message' => 'Cliente cadastrado com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao cadastrar cliente.'], 500);
        }
    }

    public function show(Cliente $cliente)
    {
        try {

            $cliente->load('usuario');
            return response()->json([
                'id' => $cliente->id,
                'cliente_nome' => $cliente->cliente_nome,
                'usuario_id' => $cliente->usuario_id
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao retornar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao retornar cliente:'], 500);
        }
    }

    public function update(Request $request, Cliente $cliente)
    {
        try {
            $request->validate([
                'cliente_nome' => 'sometimes|required|string|max:255',
                'usuario_id' => 'sometimes|required|exists:usuarios,id',
            ]);

            $cliente->update($request->all());

            return response()->json(['message' => 'Cliente atualizado com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar cliente:'], 500);
        }
    }

    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();

            return response()->json(['message' => 'Cliente removido com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao remover cliente: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao remover cliente:'], 500);
        }
    }
}
