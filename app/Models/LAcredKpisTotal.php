<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LAcredKpisTotal extends Model
{
    use HasFactory;

    protected $table = "lacr_kpistotal";

    protected $fillable = [
        'Atualizacao',
        'ValorCrediario',
        'ValorVencer',
        'RepVencer',
        'ValorVencido',
        'RepVencido',
        'RepProjVencido'
    ];
}
