<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::with('usuario')->get();
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
