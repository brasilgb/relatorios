<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelGrafVenLojas extends Model
{
    use HasFactory;

    protected $table = 'Lfat_grafico';

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Vendas',
        'Margem',
        'Meta'
    ];
}
