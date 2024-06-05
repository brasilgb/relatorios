<?php

namespace App\Models\Supermercados;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SRComPerfAssoc extends Model
{
    use HasFactory;

    protected $table = 'scom_perfassoc';

    protected $fillable = [
        'Atualizacao',
        'Associacao',
        'Compras',
        'Rep',
        'PrazoMedio'
    ];
}
