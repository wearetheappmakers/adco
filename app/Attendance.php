<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
      protected $table = 'attendance';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

     public function user(){
        return $this->belongsTo('App\User','branch_id','id');
       }
}
