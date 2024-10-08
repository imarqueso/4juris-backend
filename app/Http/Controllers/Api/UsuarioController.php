<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
    {
        return Usuario::with('empresa')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario_nome' => 'required|string|max:255',
            'empresa_id' => 'required|exists:empresas,id',
        ]);

        return Usuario::create($request->all());
    }

    public function show(Usuario $usuario)
    {
        return $usuario->load('empresa');
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'usuario_nome' => 'sometimes|required|string|max:255',
            'empresa_id' => 'sometimes|required|exists:empresas,id',
        ]);

        $usuario->update($request->all());
        return $usuario;
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return response(null, 204);
    }
}
