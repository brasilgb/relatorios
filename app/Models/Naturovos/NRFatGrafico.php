<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatGrafico extends Model
{
    use HasFactory;

    protected $table = 'nfat_grafico';

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Vendas',
        'Margem'
    ];
}
