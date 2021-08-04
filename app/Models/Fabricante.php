<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fabricante extends Model
{
  protected $fillable = ['nome', 'site', 'data_do_pedido','valor_pedido'];


  public function produtos()
  {
    return $this->hasMany(Produto::class);
  }
}
