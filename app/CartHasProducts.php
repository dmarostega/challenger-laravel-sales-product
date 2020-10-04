<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartHasProducts extends Model
{
    protected $table = 'carts_has_products';

    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function Cart(){
        return $this->belongsTo(Cart::class);
    }
}
