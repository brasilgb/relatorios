<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRResGrafico extends Model
{
    use HasFactory;

    protected $table = 'nres_grafico';

    protected $fillable = [
        'Atualizacao',
        'Dia',
        'MesAtual',
        'MesAnterior',
        'AnoMesAtual'
    ];
}
