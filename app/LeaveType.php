<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
     protected $table = 'leave_type';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
