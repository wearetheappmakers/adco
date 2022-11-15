<?php

namespace App\Imports;

use App\Product;
use App\Category;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ProductsImport implements ToModel,WithHeadingRow,WithValidation
{

    public function model(array $row)
    {
        $productcategory = Category::where('name',$row['category'])->first();
        if(isset($productcategory))
        {
            $productcategory = $productcategory->id;
        } else {
            $product = new Category();
            $product->name = $row['category'];
            $product->save();
        }
        
        $product = new Product();
        $product->category_id = $productcategory->id;
        $product->name = $row['productname'];
        $product->model_code = $row['modelcode'];            
        $product->save();

    }

    public function rules(): array
    {
        return [       

        ];
    }
}
