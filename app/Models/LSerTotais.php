<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LSerTotais extends Model
{
    use HasFactory;

    protected $table = "lser_totais";

    protected $fillable = [
        'Atualizacao',
        'DiaAtual',
        'GEDia',
        'PPDia',
        'GESemana',
        'PPSemana',
        'GEMes',
        'GEMesRep',
        'PPMes',
        'PPMesRep',
        'APMes',
        'APMesRep',
        'TotServicos',
        'TotRep',
        'MetaMes',
        'VendaMes',
        'FaltaVenderMes',
        'AtingidoMes',
        'RepFatMes',
        'MetaGEMes',
        'VendaGEMes',
        'FaltVenderGEMes',
        'AtingidoGEMes',
        'QtdVendaGEMes',
        'ElegiveisGEMes',
        'ConversaoGEMes',
        'MetaPPMes',
        'VendaPPMes',
        'FaltVenderPPMes',
        'AtingidoPPMes',
        'QtdVendaPPMes',
        'ElegiveisPPMes',
        'ConversaoPPMes',
        'MetaAPMes',
        'VendaAPMes',
        'FaltVenderAPMes',
        'AtingidoAPMes',
        'MetaEPMes',
        'VendaEPMes',
        'FaltVenderEPMes',
        'AtingidoEPMes',
        'MetaDia',
        'VendaDia',
        'PerfDia',
        'QtdVendaGEDia',
        'ElegiveisGEDia',
        'ConversaoGEDia',
        'QtdVendaPPDia',
        'ElegiveisPPDia',
        'ConversaoPPDia',
        'MediaDia',
        'PerfValorGE',
        'PerfRepGE',
        'PerfMetaGE',
        'PerfValorPP',
        'PerfRepPP',
        'PerfMetaPP',
        'PerfValorAP',
        'PerfRepAP',
        'PerfMetaAP',
        'PerfValorEP',
        'PerfRepEP'
    ];
}
