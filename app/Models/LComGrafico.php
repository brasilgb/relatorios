<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LComGrafico extends Model
{
    use HasFactory;
    
    protected $table = "lcom_grafico";

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Compras'
    ];
}
