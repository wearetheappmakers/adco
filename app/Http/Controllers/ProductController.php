<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ProductController extends Controller
{
    public function __construct(Product $s)
    {
        $this->view = 'product';
        $this->route = 'product';
        $this->viewName = 'Product';

    }
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Product::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'product'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('product.index');
    }

    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['category'] = Category::get();
        return view('general.add_form')->with($data);
    }

    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $param = Product::create($data);
        if($param)
        {
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }
    }

    
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Product::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['category'] = Category::get();
        return view('general.edit_form')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        unset($data['_method'],$data['_token']);
        $data = Product::where('id', $id)->update($data);
        if($data)
        {
            return response()->json(['status' => 'success']);
        }else
        {
            return response()->json(['status' => 'error']);

        }
    }


    public function destroy($id)
    {
        //
    }

    public function product_export() 
    {
        return Excel::download(new ProductsExport, 'product.xlsx');
    }

    public function product_import(Request $request) 
    {
        if($request->ajax() && $request->isMethod('post')){
            Excel::import(new ProductsImport, $request->file('product_excel'));
            return response()->json(['status'=>'success']);
        } else {
            return view('product.index');
        }
    }
}
