<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [

        'descricao',
        'preco',
        'fabricante_id',
        'P',
        'M',
        'G'


    ];

    public function fabricante()
    {
        return $this->belongsTo(Fabricante::class);
    }
    
}
