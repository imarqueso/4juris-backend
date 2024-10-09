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
            // Carrega os clientes com o relacionamento 'usuario'
            $clientes = Cliente::with('usuario.empresa')->get();

            // Mapeia os resultados para o formato desejado
            $resultados = $clientes->map(function ($cliente) {
                return [
                    'id' => $cliente->id,
                    'cliente_nome' => $cliente->cliente_nome,
                    'usuario_nome' => $cliente->usuario ? $cliente->usuario->usuario_nome : null,
                    'empresa_nome' => $cliente->usuario->empresa->empresa_nome, // Usando o accessor diretamente
                ];
            });

            // Retorna a resposta em JSON
            return response()->json($resultados, 200);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar clientes: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao buscar clientes.'], 500);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_nome' => 'required|string|max:255',
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        return Cliente::create($request->all());
    }

    public function show(Cliente $cliente)
    {
        return $cliente->load('usuario');
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'cliente_nome' => 'sometimes|required|string|max:255',
            'usuario_id' => 'sometimes|required|exists:usuarios,id',
        ]);

        $cliente->update($request->all());
        return $cliente;
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return response(null, 204);
    }
}
