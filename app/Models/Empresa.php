<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }

    protected static function booted()
    {
        static::addGlobalScope('empresa', function (Builder $builder) {
            if (auth()->check()) {
                $empresaId = auth()->user()->empresa_id;
                $builder->where('empresa_id', $empresaId);
            }
        });
    }
}
