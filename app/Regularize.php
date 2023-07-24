<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regularize extends Model
{
    protected $table = 'regularize';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function attendances(){
        return $this->belongsTo('App\Attendance','attendance_id','id');
    }

    public function branchs(){
        return $this->belongsTo('App\User','branch_id','id');
    }

    public function users(){
        return $this->belongsTo('App\User','employee_id','id');
    }

}
