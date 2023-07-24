<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
     protected $table = 'lead';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

     public function branch(){
        return $this->belongsTo('App\User','branch_id','id');
    }

     public function employees(){
        return $this->belongsTo('App\User','employee_id','id');
    }
}
