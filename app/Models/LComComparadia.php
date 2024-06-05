<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LComComparadia extends Model
{
    use HasFactory;

     protected $table = "lcom_comparadia";

     protected $fillable = [
         'Atualizacao',
         'Assoc',
         'CompraDia',
         'CompraAnterior',
         'CompraSemana',
         'CompraMes',
         'ColorRep',
         'Rep',
         'PrazoMedio'
        ];

}
