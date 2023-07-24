<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hsn extends Model
{
    protected $table = 'hsn';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];

    public function gsts()
    {
        return $this->belongsTo(GST::class,'gst_id','id');
    }
}
