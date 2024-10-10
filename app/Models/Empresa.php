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

    protected static function booted()
    {
        static::addGlobalScope('empresa', function (Builder $builder) {
            if (auth()->check()) {
                $builder->where('id', auth()->user()->empresa_id);
            }
        });
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
