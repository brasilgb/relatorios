<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRComGrafico extends Model
{
    use HasFactory;

    protected $table = 'scom_grafico';

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Compras'
    ];
}
