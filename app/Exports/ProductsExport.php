<?php

namespace App\Exports;

use App\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductsExport implements WithHeadings  
{
    public function headings(): array
    {
        return [
            
            'category',
            'productname',
            'modelcode',               
        ];
    }
}
