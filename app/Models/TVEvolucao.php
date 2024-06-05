<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TVEvolucao extends Model
{
    use HasFactory;

    protected $table = "ltv_evolucao";

    protected $fillable = [
        'DiaSemana',
        'Venda',
        'Meta',
    ];
}
