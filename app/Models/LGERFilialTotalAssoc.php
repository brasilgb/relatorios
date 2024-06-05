<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERFilialTotalAssoc extends Model
{
    use HasFactory;
	protected $table = 'lger_filialtotalassoc';
	protected $fillable = [
	"Atualizacao",
    "FilialId",
    "Filial",
    "MetaMes",
    "MediaFatuMes",
    "MargemMes",
    "RepFatuMes",
	
    "MetaAlcancadaMes",
    "MedJurSParcMes",
    "RepJurosMes",
    "FaturamentoAss",
    "MargemAss",
    "RepFatAss",
    "JurSFatAss",
    "RepJurosAss",
    "EstoqueAss",
    "GiroAss",
    "RepEstoqueAss"
	];
}