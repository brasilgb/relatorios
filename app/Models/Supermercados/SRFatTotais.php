<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRFatTotais extends Model
{
    use HasFactory;

    protected $table = 'sfat_totais';

    protected $fillable = [
        'Atualizacao',
        'VendaDia',
        'DiaAtual',
        'DiaAnterior',
        'MargemDia',
        'VendaAnterior',
        'MargemAnterior',
        'VendaSemana',
        'MargemSemana',
        'VendaMes',
        'MargemMes',
        'RepFatMesAno',
        'RepVendaMes',
        'RepFatAnoMes',
        'ValorMeta',
        'RepSobreMeta',
        'PerfMesMeta',
        'PerfMesVenda',
        'PerfMesFaltVender',
        'PerfMesMetaParcial',
        'PerfMesAtingido',
        'PerfMesPerf',
        'PerfDiaMeta',
        'PerfDiaVenda',
        'PerfDiaFaltaVender',
        'PerfDiaPerf',
        'MediaDia',
        'MediaFatuPerfMes',
        'MargemFatuPerfMes',
        'RepFatuPerfMes',
        'MetaFatuPerfMes',
        'FatuPerfAssoc',
        'MargemPerfAssoc',
        'RepFatPerfAssoc',
        'EstoquePerfAssoc',
        'GiroPerfAssoc',
        'RepEstoquePerfAssoc'
    ];
}
