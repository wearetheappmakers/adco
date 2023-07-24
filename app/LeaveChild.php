<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaveChild extends Model
{
     protected $table = 'leave_child';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
