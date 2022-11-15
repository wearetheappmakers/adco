<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class So extends Model
{
    protected $table = 'so';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function users(){
        return $this->belongsTo('App\User','branch_id','id');
    }

    public function customers(){
        return $this->belongsTo('App\Customer','customer_id','id');
    }
}
