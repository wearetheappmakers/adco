<?php

namespace App\Exports;
use App\Hsn;
use App\GST;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;


class HsnExport implements FromCollection,WithHeadings
{
     public function headings(): array
    {
        return [            
            'gst',
            'hsn_code',                   
            'name_of_print',                   
            'fix_rate',                   
            'rcp',                   
            'fsp',                   
            'rack_no',                   
            'mrp',                   
        ];
    }


    public function collection()
     {
         $data = Hsn::with('gsts')->select('gst_id','name','name_of_print','fix_rate','rcp','fsp','rack_no','mrp')->get();
        foreach($data as $key=>$value)
        {          
            $data[$key]->gst_id = GST::where('id',$value->gst_id)->value('name');
            if($data[$key]['fix_rate'] == 1)
            {
                $data[$key]['fix_rate'] = 'yes';
            }
            elseif($data[$key]['fix_rate'] == 2){
                 $data[$key]['fix_rate'] = 'no';
            }  
        }
        return $data;
    }
   
}
