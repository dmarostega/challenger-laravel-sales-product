<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';

    public function Itens()
    {
        return $this->hasMany(CartHasProducts::class);        
    }
}
