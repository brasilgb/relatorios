<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LComPerfMes extends Model
{
    use HasFactory;

    protected $table = "lcom_perfmes";

    protected $fillable = [
        'Atualizacao',
        'MesAno',
        'MediaCompra',
        'Rep',
        'PrazoMedio'
    ];
}
