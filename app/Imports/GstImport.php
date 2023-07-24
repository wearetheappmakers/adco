<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\GST;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class GstImport implements ToModel,WithHeadingRow,WithValidation
{

    public function model(array $row)
    {
        $gst = GST::where('name',$row['gst'])->first();
        if(!(isset($gst)))
        {
            $gst = new GST();
            $gst->name = $row['gst'];
            $gst->save();
        }
        
    }

    public function rules(): array
    {
        return [

            // '*.productcategory' => 'required',
        ];
    }
}
