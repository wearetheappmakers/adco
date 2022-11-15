<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stock;
use App\StockChild;
use App\Product;
use App\Category;
use App\User;
use DataTables;
use Auth;


class StockController extends Controller
{

    public function __construct(Stock $s)
    {
        $this->view = 'stock';
        $this->route = 'stock';
        $this->viewName = 'Stock';

    }
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
                $query = Stock::with('categorys','products','users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = Stock::with('categorys','products','users')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            }
             elseif(Auth::user()->role == 3){
                $query = Stock::with('categorys','products','users')->where('user_id',Auth::user()->branch_id)->orderBy('id','DESC')->latest();
            }
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
               {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'stock'])->render();                           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('stock.index');
    }

    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['user'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        return view('general.add_form')->with($data);
    }


    public function store(Request $request)
    {
        $stock = new Stock();
        if(Auth::user()->role == 1){
            $stock->user_id = $request->user_id;
        } elseif (Auth::user()->role == 2){
            $stock->user_id = Auth::user()->id;
        } elseif (Auth::user()->role == 3){
            $stock->user_id = Auth::user()->branch_id;
        }
        $stock->category_id = $request->category_id;
        $stock->product_id = $request->product_id;
        $stock->price = $request->price;
        $stock->no_of_product = $request->no_of_product;
        $stock->save();

        if(isset($request->serial_no)) 
        {
            foreach ($request->serial_no as $key => $value) 
            {
                if ($value != '') 
                {
                    $srno = new StockChild();
                    $srno->stock_id = $stock->id;
                    $srno->user_id = $stock->user_id;
                    $srno->category_id = $stock->category_id;
                    $srno->product_id = $stock->product_id;
                    $srno->price = $stock->price;
                    $srno->serial_no = $value;
                    $srno->save();
                }
            }
        }

        if($stock)
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
        $data['data'] = Stock::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['user'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        $data['product'] = Product::get();
        $data['serial'] = StockChild::where('stock_id',$id)->get();
        return view('general.edit_form')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_method'],$data['_token'],$data['user_id'],$data['category_id'],$data['product_id'],$data['serial_no'],$data['no_of_product'],$data['child_id'],$data['price']);
        $data = Product::where('id', $id)->update($data);
        foreach($request->child_id as $key => $value)
        {
            $datas = [
                'stock_id' => $id,
                'serial_no' => $request->serial_no[$key],
            ];
            $sites = StockChild::where('id',$value)->update($datas);
        }
        
        if($sites)
        {
            return response()->json(['status' => 'success']);
        }else
        {
            return response()->json(['status' => 'error']);

        }
        
    }

    
    public function destroy($id)
    {
        $data = Stock::where('id',$id)->delete();
        $data = StockChild::where('stock_id',$id)->delete();
        if($data)
        {
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }
    }

    public function geteproduct(Request $request)
    {
        $data = Product::where('category_id',$request->category_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

        return response()->json(['data'=>$html]);
    }
}
