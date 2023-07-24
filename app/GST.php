<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GST extends Model
{
      protected $table = 'gst';
      protected $primaryKey = 'id';
      protected $guarded = ['id'];
}
