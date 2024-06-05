<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRFatGrafico extends Model
{
    use HasFactory;

    protected $table = 'sfat_grafico';

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Vendas',
        'Margem',
		'Meta'
    ];
}
