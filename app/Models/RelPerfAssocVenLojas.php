<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelPerfAssocVenLojas extends Model
{
    use HasFactory;

    protected $table = "lfat_perfassoc";

    protected $fillable = [
        'Atualizacao',
        'Assoc',
        'Faturamento',
        'Margem',
        'RepFat',
        'JurSFat',
        'RepJuros',
        'Estoque',
        'Giro',
        'RepEstoque'
    ];
}
