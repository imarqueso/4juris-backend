<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['usuario_nome', 'empresa_id', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('empresa', function (Builder $builder) {
            if (auth()->check()) {
                $companyId = auth()->user()->empresa_id;
                $builder->where('empresa_id', $companyId);
            }
        });
    }
}
