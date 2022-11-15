<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function users(){
        return $this->belongsTo('App\User','branch_id','id');
    }
}
