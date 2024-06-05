<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRFatComparativo extends Model
{
    use HasFactory;

    protected $table = 'sfat_comparativo';

    protected $fillable = [
        'Atualizacao',
        'Associacao',
        'VendaDia',
        'MargemDia',
        'VendaAnterior',
        'MargemAnterior',
        'VendaSemana',
        'MargemSemana',
        'VendaMes',
        'MargemMes',
        'RepMargemMesAno',
        'RepFatMes',
        'RepFatMesAno',
        'Meta',
        'RepMesMeta'
    ];
}
