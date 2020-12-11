<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemVenda extends Model
{
    protected $fillable = [

        'vendas_id',
        'produto_id',
        'quantidade',
        'valor_unitario',
        'valor_total'


    ];
}
