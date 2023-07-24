<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeavePolicyChild extends Model
{
     protected $table = 'leave_policy_child';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
