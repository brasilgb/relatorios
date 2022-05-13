<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredKpis extends Model
{
    use HasFactory;

    protected $table = "lacr_kpis";

    protected $fillable = [
        'Atualizacao',
        'CodFilial',
        'Filial',
        'ValorCrediario',
        'ValorVencer',
        'RepVencer',
        'ValorVencido',
        'RepVencido',
        'RepProjVencido'
    ];
} 
