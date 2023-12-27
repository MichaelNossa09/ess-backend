<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoolEvento extends Model
{
    use HasFactory;

    protected $fillable = [
        'pool_id',
        'evento_id',
    ];

    protected $table = 'pool_eventos';
}
