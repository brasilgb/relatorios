<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LSerGrafico extends Model
{
    use HasFactory;

    protected $table = "lser_grafico";

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Vendas',
        'Meta'
    ];
}
