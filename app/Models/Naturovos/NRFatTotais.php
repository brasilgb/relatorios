<?php

namespace App\Models\Naturovos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NRFatTotais extends Model
{
    use HasFactory;

    protected $table = 'nfat_totais';

    protected $fillable = [
        'Atualizacao',
        'DiaAtual',
        'DiaVendaDia',
        'DiaMargemDia',
        'DiaVendaSemana',
        'DiaMargemSemana',
        'DiaVendaMes',
        'DiaMargemMes',
        'DiaRepTotal',
        'PMesFaturamento',
        'PMesMargem',
        'PMesRepTotal',
        'PMesPrecoMedioKg',
        'PAssFaturamento',
        'PAssMargem',
        'PAssRepTotal',
        'PAssPrecoMedioKg',
        'PAssFaturamentoEC',
        'PAssRepEC',
        'PAssMargemEC',
        'MediaDia'
    ];
}
