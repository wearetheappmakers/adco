<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stocks';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function users(){
        return $this->belongsTo('App\User','user_id','id');
    }

    public function categorys(){
        return $this->belongsTo('App\Category','category_id','id');
    }

    public function products(){
        return $this->belongsTo('App\Product','product_id','id');
    }
}
