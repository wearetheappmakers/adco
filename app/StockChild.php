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
}
