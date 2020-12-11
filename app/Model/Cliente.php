<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'telefone',
        'email',
        'cpf',
        'cep',
        'logradouro',
        'bairro',
        'localidade'

    ];
}
