<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bsr extends Model
{
      protected $table = 'bsrs';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
