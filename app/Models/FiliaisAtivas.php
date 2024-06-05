<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FiliaisAtivas extends Model
{
    use HasFactory;
    protected $table = 'filiaisativas';

    protected $fillable = [
        'CodFilial',
        'NomeFilial',
        'BairroFilial',
        'EnderecoFilial',
        'GerenteFilial'
    ];
}