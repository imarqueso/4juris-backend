<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = ['usuario_nome', 'empresa_id', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class);
    }

    public function clientes()
    {
        return $this->hasMany(Cliente::class);
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
