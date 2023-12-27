<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servidor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nodo_id',
        'encendido',
        'nombre',
        'almacenamiento_total',
        'descripción',
    ];

    protected $table = 'servidores';

    public function nodo()
    {
        return $this->belongsTo(Nodo::class);
    }

    public function servidoresAsociados()
    {
        return $this->hasMany(Servidor::class, 'nodo_id');
    }

    public function estatus()
    {
        return $this->belongsToMany(Estatus::class, 'estatus_servidor', 'servidor_id', 'estatus_id')
            ->withPivot([
                'almacenamiento_disponible',
                'almacenamiento_ocupado',
                'porcentaje_disponible',
                'cpu',
                'memoria',
                'consumo_de_red',
            ]);
    }
}
