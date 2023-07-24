<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weekoff extends Model
{
    protected $table = 'weekoff';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
