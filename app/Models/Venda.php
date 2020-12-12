<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $fillable = [
        'forma_pagamento',
        'observacao',
        'desconto',
        'acrescimo',
        'total',
        'cliente_id',
        
    ];
    const DINHEIRO =0;
    const CARTAO = 1;

    const FORMAS_PAGAMENTO = [
        self::DINHEIRO => 'Dinheiro',
        self::CARTAO => 'Cartão'
    ];
}
