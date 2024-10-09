<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cliente::create([
            'cliente_nome' => 'Cliente Teste 1',
            'usuario_id' => 1,
        ]);
        Cliente::create([
            'cliente_nome' => 'Cliente Teste 2',
            'usuario_id' => 1,
        ]);
        Cliente::create([
            'cliente_nome' => 'Cliente Teste 3',
            'usuario_id' => 1,
        ]);
        Cliente::create([
            'cliente_nome' => 'Cliente Teste 4',
            'usuario_id' => 1,
        ]);
    }
}
