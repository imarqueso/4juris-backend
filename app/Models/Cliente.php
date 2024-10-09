<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = ['cliente_nome', 'usuario_id'];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    protected static function booted()
    {
        static::addGlobalScope('usuario', function (Builder $builder) {
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $builder->where('usuario_id', $userId);
            }
        });
    }
}
