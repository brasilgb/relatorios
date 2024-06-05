<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRFatPerfAssoc extends Model
{
    use HasFactory;

    protected $table = 'sfat_perfassoc';

    protected $fillable = [
        'Atualizacao',
        'Associacao',
        'Faturamento',
        'Margem',
        'RepFat',
        'Estoque',
        'Giro',
        'RepEstoque'
    ];
}
