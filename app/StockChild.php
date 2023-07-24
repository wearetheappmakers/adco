<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockChild extends Model
{
    protected $table = 'stock_child';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function stocks(){
        return $this->belongsTo('App\Stock','stock_id','id');
    }

    public function category(){
        return $this->belongsTo('App\Category','category_id','id');
    }

     public function product(){
        return $this->belongsTo('App\Product','product_id','id');
    }

    
}
