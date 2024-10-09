<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $fillable = ['empresa_nome'];

    // Se você não precisa de um escopo global, remova o método booted
    // Caso contrário, ajuste o escopo da seguinte forma:

    protected static function booted()
    {
        // Remova ou ajuste o escopo, dependendo da sua necessidade
        static::addGlobalScope('empresa', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('id', auth()->user()->empresa_id); // Use 'id' para filtrar
            }
        });
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
