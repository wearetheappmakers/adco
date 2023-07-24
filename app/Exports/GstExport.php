<?php

namespace App\Exports;
use App\GST;
use App\ProductCategory;
use App\Company;

use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\WithHeadings;


class GstExport implements FromCollection,WithHeadings
{
     public function headings(): array
    {
        return [            
            'gst',                               
        ];
    }


    public function collection()
     {
         $data = GST::select('name')->get();        
        return $data;
    }

   
}
