<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    protected $table = 'holiday';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
