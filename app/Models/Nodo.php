<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nodo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'descripción',
    ];

    protected $table = 'nodos';


    public function servidores()
    {
        return $this->hasMany(Servidor::class, 'nodo_id');
    }
}
