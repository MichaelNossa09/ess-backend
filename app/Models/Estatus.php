<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'registrado_por',
        'v_fisica_1',
        'v_fisica_2',
        'aprobado_por',
        'observaciones',
        'estado',
    ];

    public function servidores()
    {
        return $this->belongsToMany(Servidor::class, 'estatus_servidor', 'estatus_id', 'servidor_id')
            ->withPivot([
                'almacenamiento_disponible',
                'almacenamiento_ocupado',
                'porcentaje_disponible',
                'cpu',
                'memoria',
                'consumo_de_red',
            ]);
    }
    protected $table = 'estatus';
}
