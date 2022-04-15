<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERConversaoFiliais extends Model
{
    use HasFactory;

    protected $table = "lger_conversaofiliais";

    protected $fillable = [
        'Atualizacao',
        'RotuloFaturado',
        'MelhorFaturado',
        'ValorMeta',
        'MetaAlcancada',
        'RotuloMelhorPP',
        'ValorMelhorPP',
        'MediaMelhorPP',
        'RotuloMelhorGE',
        'ValorMelhorGE',
        'MediaMelhorGE',
        'RotuloMelhorAP',
        'ValorMelhorAP',
        'MediaMelhorAP',
        'RotuloMelhorEP',
        'ValorMelhorEP',
        'MediaMelhorEP',
        'RotuloMelhorVenda',
        'ValorMelhorVenda',
        'MediaMelhorVenda',
        'RotuloTaxaJuros',
        'ValorTaxaJuros',
        'MediaTaxaJuros',
        'RotuloProjecao',
        'ValorProjecao',
        'MediaProjecao',
        'RotuloMetaDia',
        'MetaAlcancadaDia',
        'MediaMetaDia'
    ];
}
