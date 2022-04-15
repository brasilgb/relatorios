<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERAnaliseFiliais extends Model
{
    use HasFactory;

    protected $table = "lger_analisefiliais";

    protected $fillable = [
        'Atualizacao',
        'Cod_Filial',
        'Filial',
        'Valor_Faturado',
        'Valor_Meta',
        'Meta_Vendas',
        'Margem',
        'ValorGE',
        'MetaGE',
        'ElegiveisGE',
        'VendasGE',
        'Meta_GE_Atingida',
        'GE_Convertida',
        'ValorPP',
        'MetaPP',
        'ElegiveisPP',
        'VendasPP',
        'Meta_PP_Atingida',
        'PP_Convertida',
        'ValorAP',
        'MetaAP',
        'VendasAP',
        'Meta_AP_Atingida',
        'ValorEP',
        'MetaEP',
        'Meta_EP_Atingida',
        'TaxaJurosFilial',
        'ValorTaxaJuros',
        'ValorProjecaoVenda',
        'PercentProjecaoVenda',
        'ValorFaturamentoDia',
        'ValorMetaDia',
        'ValorAlcancadoDia'
    ];
}
