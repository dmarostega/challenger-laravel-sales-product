<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    protected $table = 'carts';
    protected $dates = ['deleted_at'];
    use SoftDeletes;

    public function Itens()
    {
        return $this->hasMany(CartHasProducts::class);        
    }

    public function TotalValue(){
        $sum = 0;

        foreach($this->hasMany(CartHasProducts::class)->get() as $item){
            // var_dump(DB::table('products')->where('id','=',$item->product_id)->first() );
            $sum += DB::table('products')->where('id','=',$item->product_id)->first()->price * $item->quantity;
        }

        return $sum;
    }    
}
