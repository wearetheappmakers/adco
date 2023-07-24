<?php

namespace App\Imports;

use App\Product;
use App\Category;
use App\GST;
use App\Group;
use App\Unit;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel,WithHeadingRow,WithValidation
{

    public function model(array $row)
    {
        $productcategory = Category::where('name',$row['category'])->first();
        if(!(isset($productcategory)))
        {
        //     $productcategory = $productcategory->id;
        // } else {
            $productcategory = new Category();
            $productcategory->name = $row['category'];
            $productcategory->save();
        }

        $gst = GST::where('name',$row['gst'])->first();
        if(!(isset($gst)))
        {
            $gst = new GST();
            $gst->name = $row['gst'];
            $gst->save();
        }

        if($row['group_name'])
        {

            $group = Group::where('name',$row['group_name'])->first();
            if(!(isset($group)))
            {
                $group = new Group();
                $group->name = $row['group_name'];
                $group->save();
            }
        }

        if($row['sale'])
        {

            $sale = Unit::where('name',$row['sale'])->first();
            if(!(isset($sale)))
            {
                $sale = new Unit();
                $sale->name = $row['sale'];
                $sale->save();
            }
        }

        if($row['purchase'])
        {
            $purchase = Unit::where('name',$row['purchase'])->first();
            if(!(isset($purchase)))
            {
                $purchase = new Unit();
                $purchase->name = $row['purchase'];
                $purchase->save();
            }
        }
        if($row['gst_unit'])
        {
             $gst_unit = Unit::where('name',$row['gst_unit'])->first();
             if(!(isset($gst_unit)))
             {
                $gst_unit = new Unit();
                $gst_unit->name = $row['gst_unit'];
                $gst_unit->save();
            }
        }


        
       
            
        $product = Product::where('category_id',$productcategory->id)->where('name',$row['productname'])->where('model_code',$row['modelcode'])->where('gst_id',$gst->id)->first();

       
        if($product)
        {

        }
        else
        {
            
            $product = new Product();
            $product->category_id = $productcategory->id;
            $product->name = $row['productname'];
            $product->model_code = $row['modelcode'];            
            $product->gst_id = $gst->id;  
            $product->alias = $row['alias'];
            $product->group_name = $group->id;
            if($row['stock_required'] == 'Yes')
            {
                $product->stock_required = 1;
            }
            elseif($row['stock_required'] == 'No'){
                 $product->stock_required = 2;
            }

            if($row['price_list'] == 'Yes')
            {
                $product->price_list = 1;
            }
            elseif($row['price_list'] == 'No'){
                 $product->price_list = 2;
            }

            if($row['locationwise_stock'] == 'Yes')
            {
                $product->locationwise_stock = 1;
            }
            elseif($row['locationwise_stock'] == 'No'){
                 $product->locationwise_stock = 2;
            }

            if($row['serialno_stock'] == 'Yes')
            {
                $product->serialno_stock = 1;
            }
            elseif($row['serialno_stock'] == 'No'){
                 $product->serialno_stock = 2;
            }

            if($row['tcs'] == 'Yes')
            {
                $product->tcs = 1;
            }
            elseif($row['tcs'] == 'No'){
                 $product->tcs = 2;
            }
            $product->purchase_rate = $row['purchase_rate'];
            $product->sales_rate = $row['sales_rate'];
            $product->tax_paid_rate = $row['tax_paid_rate'];
            $product->sale = $sale->id;
            $product->purchase = $purchase->id;
            $product->gst_unit = $gst_unit->id;
            $product->quantity = $row['quantity'];
            $product->amount = $row['amount'];
                      
            $product->save();
        }
        // dd($product);

    }

    public function rules(): array
    {
        return [       

        ];
    }
}
