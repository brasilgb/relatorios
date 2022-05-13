<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LGERMargemVendedor extends Model
{
    use HasFactory;

    protected $table = "lger_margemvendedor";

    protected $fillable = [
        'ano',
        'mes',
        'filial',
        'vendedor',
        'margem'
    ];
}