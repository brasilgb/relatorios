<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LComPerfAssoc extends Model
{
    use HasFactory;

    protected $table = "lcom_perfassoc";

    protected $fillable = [
        'Atualizacao',
        'Assoc',
        'Compras',
        'Rep',
        'PrazoMedio'
    ];
}
