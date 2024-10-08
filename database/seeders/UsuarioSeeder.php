<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::create([
            'usuario_nome' => 'Admin',
            'email' => 'admin@email.com',
            'password' => Hash::make('admin4321'),
            'empresa_id' => 1,
        ]);
    }
}
