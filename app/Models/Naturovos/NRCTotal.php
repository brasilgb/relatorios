<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRCTotal extends Model
{
    use HasFactory;

    protected $table = 'ncom_totais';

    protected $fillable = [
        'Atualizacao',
        'DiaAtual',
        'ComCompraDia',
        'ComCompraSemana',
        'ComCompraMes',
        'ComRepTotal',
        'MesMedia',
        'MesRepTotal',
        'PerCompra',
        'PerRepTotal',
        'PerCompraEC',
        'PerRepTotalEC'
    ];
}
