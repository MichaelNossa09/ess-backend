<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conectividad extends Model
{
    use HasFactory;

    protected $fillable = [
        'estado_conectate',
        'velocidad_conectate',
        'estado_itelkom',
        'velocidad_itelkom',
        'alertas_graves',
        'observaciones_graves',
        'alertas_medias',
        'observaciones_medias',
        'alertas_menores',
        'observaciones_menores',
        'alertas_totales',
        'informacion_workspace',
        'pico_entrante_max_itelkom',
        'pico_salida_max_itelkom',
        'pico_entrante_max_conectate',
        'pico_salida_max_conectate',
        'temperatura_datacenter',
        'registrado_por',
        'aprobado_por',
        'observaciones',
        'v_fisica_1',
        'v_fisica_2',
    ];

    protected $table = 'conectividad';
}
