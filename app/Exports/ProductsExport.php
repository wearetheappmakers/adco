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
            'gst',               
            'alias', 
            'group_name',
            'stock_required',
            'price_list',
            'locationwise_stock',
            'serialno_stock',
            'tcs',
            'purchase_rate',
            'sales_rate',
            'tax_paid_rate',
            'sale',
            'purchase',
            'gst_unit',
            'quantity',
            'amount',              
        ];
    }
}
