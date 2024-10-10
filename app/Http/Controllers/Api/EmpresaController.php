<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmpresaController extends Controller
{
    public function index()
    {
        try {

            $empresas = Empresa::all();

            $resultados = $empresas->map(function ($empresa) {
                return [
                    'id' => $empresa->id,
                    'empresa_nome' => $empresa->empresa_nome,
                ];
            });

            return response()->json($resultados);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar empresas: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao buscar empresas.'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate(['empresa_nome' => 'required']);

            Empresa::create($request->all());

            return response()->json(['message' => 'Empresa cadastrada com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao cadastrar o empresa: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao cadastrar o empresa.'], 500);
        }
    }

    public function show(Empresa $empresa)
    {
        try {

            $empresa->load('usuarios');

            return response()->json([
                'id' => $empresa->id,
                'empresa_nome' => $empresa->empresa_nome,
            ]);
        } catch (\Exception $e) {
            Log::error('Erro ao retornar empresa: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao retornar empresa:'], 500);
        }
    }

    public function update(Request $request, Empresa $empresa)
    {
        try {
            $request->validate(['empresa_nome' => 'required']);

            $empresa->update($request->all());

            return response()->json(['message' => 'Empresa atualizada com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar empresa: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao atualizar empresa:'], 500);
        }
    }

    public function destroy(Empresa $empresa)
    {
        try {
            $empresa->delete();

            return response()->json(['message' => 'Empresa removida com sucesso!']);
        } catch (\Exception $e) {
            Log::error('Erro ao remover empresa: ' . $e->getMessage());
            return response()->json(['error' => 'Erro ao remover empresa:'], 500);
        }
    }
}
