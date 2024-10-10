<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{
    public function index()
    {
        return Empresa::all();
    }

    public function store(Request $request)
    {
        $request->validate(['empresa_nome' => 'required']);
        return Empresa::create($request->all());
    }

    public function show(Empresa $empresa)
    {
        $empresa->load('usuarios');

        return response()->json($empresa);
    }

    public function update(Request $request, Empresa $empresa)
    {
        $request->validate(['empresa_nome' => 'required']);
        $empresa->update($request->all());
        return $empresa;
    }

    public function destroy(Empresa $empresa)
    {
        $empresa->delete();
        return response(null, 204);
    }
}
