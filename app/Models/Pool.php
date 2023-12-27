<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pool extends Model
{
    use HasFactory;

    protected $fillable = [
        'capacidad_pool_a',
        'capacidad_disponible_pool_a',
        'porcentaje_disponible_pool_a',
        'capacidad_pool_b',
        'capacidad_disponible_pool_b',
        'porcentaje_disponible_pool_b',
        'v_fisica_1',
        'v_fisica_2',
        'registrado_por',
        'aprobado_por',
        'observaciones',
    ];

    protected $table = 'pools';


    public function eventos()
    {
        return $this->belongsToMany(Evento::class, 'pool_eventos', 'pool_id', 'evento_id');
    }
}
