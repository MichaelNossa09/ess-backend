<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'observación',
    ];

    protected $table = 'eventos';

    public function pools()
    {
        return $this->belongsToMany(Pool::class, 'pool_eventos', 'evento_id', 'pool_id');
    }
}
