<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCGrafico extends Model
{
    use HasFactory;

    protected $table = 'ncom_perfgrafico';

    protected $fillable = [
        'Atualizacao',
        'DiaSemana',
        'Compras'
    ];
}
