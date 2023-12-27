<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstatusServidor extends Model
{
    use HasFactory;

    protected $fillable = [
        'estatus_id',
        'servidor_id',
        'almacenamiento_disponible',
        'almacenamiento_ocupado',
        'porcentaje_disponible',
        'cpu',
        'memoria',
        'consumo_de_red',
    ];

    protected $table = 'estatus_servidor';
}
