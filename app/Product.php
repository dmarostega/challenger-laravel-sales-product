<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';
    protected $dates = ['deleted_at'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
}
