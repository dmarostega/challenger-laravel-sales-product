<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'carts';

    public function Itens()
    {
        return $this->hasMany(CartHasProducts::class);        
    }

    public function TotalValue(){
        $sum = 0;

        foreach($this->hasMany(CartHasProducts::class)->get() as $item){
            $sum += Product::find($item->product_id)->price * $item->quantity;
        }

        return $sum;
    }    
}
