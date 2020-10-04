<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CartHasProducts extends Model
{
    use SoftDeletes;

    protected $table = 'carts_has_products';
    protected $dates = ['deleted_at'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }

    public function Cart(){
        return $this->belongsTo(Cart::class);
    }
}
