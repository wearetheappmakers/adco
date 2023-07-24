<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeavePolicy extends Model
{
     protected $table = 'leave_policy';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
