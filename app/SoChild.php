<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SoChild extends Model
{
    protected $table = 'so_child';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function sos(){
        return $this->belongsTo('App\So','so_id','id');
    }

    public function categorys(){
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function products(){
        return $this->belongsTo('App\Product','product_id','id');
    }

    public function stock_childs(){
        return $this->hasMany('App\StockChild','id','id');
    }
}
