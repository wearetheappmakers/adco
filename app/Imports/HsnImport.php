<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Hsn;
use App\GST;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class HsnImport implements ToModel,WithHeadingRow,WithValidation
{

    public function model(array $row)

    {
        $gstname = GST::where('name',$row['gst'])->first();
        if(!(isset($gstname)))
        {
            $gstname = new GST();
            $gstname->name = $row['gst'];
            $gstname->save();
        }

        $hsn = Hsn::where('gst_id',$gstname->id)->where('name',$row['hsn_code'])->first();
        if(!(isset($hsn)))
        {
            //  if($row['hsn_code'])
            //  {
            //     $hsn = Hsn::where('name',$row['hsn_code'])->value('name');
            //     if($hsn)
            //     {
            //         return response()->json(['status' => 'duplicate_hsn']);
            //     }
            // }
            $hsn = new Hsn();
            $hsn->gst_id =$gstname->id;
            $hsn->name = $row['hsn_code'];
            $hsn->name_of_print = $row['name_of_print'];
            // $hsn->fix_rate = $row['fix_rate'];
            if($row['fix_rate'] == 'yes')
            {
                $hsn->fix_rate = 1;
            }
            elseif($row['fix_rate'] == 'no'){
                 $hsn->fix_rate = 2;
            }
            $hsn->rcp = $row['rcp'];
            $hsn->fsp = $row['fsp'];
            $hsn->rack_no = $row['rack_no'];
            $hsn->mrp = $row['mrp'];
            $hsn->save();
          
        }
    }

    

    public function rules(): array
    {
        return [

            // '*.gst_id' => 'required',
            // '*.name' => 'required',
        ];
    }
}
