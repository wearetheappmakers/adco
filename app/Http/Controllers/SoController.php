<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\So;
use App\SoChild;
use App\User;
use App\Customer;
use App\Category;
use App\Product;
use App\StockChild;
use DataTables;
use Auth;


class SoController extends Controller
{

    public function __construct(So $s)
    {
        $this->view = 'salesorder';
        $this->route = 'salesorder';
        $this->viewName = 'Sales Order';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {

            if(Auth::user()->role == 1){
                $query = So::with('users','customers')->orderBy('id','DESC')->latest();
            } 
            elseif(Auth::user()->role == 2){
                $query = So::with('users','customers')->where('branch_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            }
            elseif(Auth::user()->role == 3){
                $query = So::with('users','customers')->where('branch_id',Auth::user()->branch_id)->orderBy('id','DESC')->latest();
            }

            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
               {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'salesorder'])->render();                           
            }
            return $btn;
        })

            ->addColumn('status', function ($row) {
                if($row->status == 2)
                {
                    $btn = '<select class="form-control" disabled><option value="1"';
                }
                else
                {
                    $btn = '<select class="form-control" onchange="status(this,'.$row->id.')"><option value="1"';
                }

                $selected = '';
                if($row->status == 1)
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Pending</option><option value="2" ';
                $selected = '';
                if($row->status == 2)
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Completed</option></select>';


                return $btn;

            })

            ->rawColumns(['action','status'])
            ->make(true);
        }
        return view('salesorder.index');
    }

    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        if(Auth::user()->role == 1){
            $data['customer'] = Customer::get();
        } elseif(Auth::user()->role == 2){
            $data['customer'] = Customer::where('branch_id',Auth::user()->id)->get();
        } elseif(Auth::user()->role == 3) {
            $data['customer'] = Customer::where('branch_id',Auth::user()->branch_id)->get();
        }
        $data['category'] = Category::get();
        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {
        $arr = [];
        foreach ($request->serial_id as $keys => $values)
        {
            $check = in_array($values,$arr);
            if($check)
            {
                // dd($check);
                return response()->json(['status' => 'duplicate_serial']);
            }
            array_push($arr,$values);
        }
        $salesorder = new So();
        if(Auth::user()->role == 1){
            $salesorder->branch_id = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $salesorder->branch_id = Auth::user()->id;
        }
        elseif (Auth::user()->role == 3){
            $salesorder->branch_id = Auth::user()->branch_id;
        }
        $salesorder->customer_id = $request->customer_id;
        $salesorder->remarks = $request->remarks;
        $salesorder->save();

        if($request->category_id)
        {
            foreach ($request->category_id as $key => $value) 
            {
                if ($value != '') 
                {
                    $edu = new SoChild();
                    $edu->so_id = $salesorder->id;
                    $edu->category_id = $value;
                    $edu->product_id = $request->product_id[$key];
                    $edu->serial_id = $request->serial_id[$key];
                    $edu->price = $request->price[$key];
                    $edu->save();
                } 
            }
        }
        if($salesorder)
        {
            return response()->json(['status' => 'success']);
        }else
        {
            return response()->json(['status' => 'error']);
        }
    }

    public function show($id)
    {
        $data['data'] = So::where('id', $id)->first();
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        if(Auth::user()->role == 1){
            $data['customer'] = Customer::get();
        } elseif(Auth::user()->role == 2){
            $data['customer'] = Customer::where('branch_id',Auth::user()->id)->get();
        } elseif(Auth::user()->role == 3) {
            $data['customer'] = Customer::where('branch_id',Auth::user()->branch_id)->get();
        } 
        $data['child'] = SoChild::where('so_id',$id)->get();
        $data['product'] = Product::get();        
        $data['stockchild'] = StockChild::get();        
        return view('salesorder.show')->with($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = So::where('id', $id)->first();
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        if(Auth::user()->role == 1){
            $data['customer'] = Customer::get();
        } elseif(Auth::user()->role == 2){
            $data['customer'] = Customer::where('branch_id',Auth::user()->id)->get();
        } elseif(Auth::user()->role == 3) {
            $data['customer'] = Customer::where('branch_id',Auth::user()->branch_id)->get();
        } 
        $data['child'] = SoChild::where('so_id',$id)->get();
        $data['product'] = Product::get();        
        $data['stockchild'] = StockChild::get();        
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        // dd($data);
        unset($data['_method'],$data['_token'],$data['branch_id'],$data['customer_id'],$data['hidden_id'],$data['old_price'],$data['category_id'],$data['product_id'],$data['serial_id'],$data['price'],$data['old_category_id'],$data['old_product_id'],$data['old_serial_id'],$data['old_price']);
        
        $arr = [];
        foreach ($request->serial_id as $keys => $values)
        {
            $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->first();
            if(isset($child_data))
            {
                return response()->json(['status' => 'duplicate_serial']);
            }
            $check = in_array($values,$arr);
            if($check)
            {
                return response()->json(['status' => 'duplicate_serial']);
            }
            array_push($arr,$values);
        }

        $datas = So::where('id', $id)->update($data);


        if(isset($request->category_id))
        {
            foreach ($request->category_id as $key => $value) 
            {
                if ($value != '') 
                {
                    $edu = new SoChild();
                    $edu->so_id = $id;
                    $edu->category_id = $value;
                    $edu->product_id = $request->product_id[$key];
                    $edu->serial_id = $request->serial_id[$key];
                    $edu->price = $request->price[$key];
                    $edu->save();
                } 
            }
        }


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

    public function status(Request $request)
    {

        $change_status = So::where('id',$request->id)->first();
        if($request->status == 2)
        {
            $child = SoChild::get();
            $arr = [];
            foreach ($child as $keys => $values)
            {
                $child = SoChild::where('serial_id',$values->serial_id)->value('serial_id');
                array_push($arr, $child);
            }
            // dd($arr);
            $array_temp = [];
            foreach($arr as $a)
            {
                if(in_array($a, $array_temp))
                {
                    return response()->json(['status' => 'duplicate_serial']);
                }
                array_push($array_temp, $a);
            }


            $change_status->status = $request->status;
            $change_status->save();
            $so_child = SoChild::where('so_id',$change_status->id)->get();
            foreach($so_child as $child){

                $data = StockChild::where('id',$child->serial_id)->get();

                foreach($data as $key=>$value)
                {
                    $value->update(['used'=>1]); 
                }
            }
        }

        if($change_status) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function getcustomer(Request $request)
    {
        $data = Customer::where('branch_id',$request->branch_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

        return response()->json(['data'=>$html]);
    }

    public function getproduct(Request $request)
    {
        $data = Product::where('category_id',$request->category_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

        echo $html;

    }

    public function getserial(Request $request)
    {
        $data = StockChild::where('used',0)->where('product_id',$request->product_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

        echo $html;

    }

    public function getprice(Request $request)
    {
        $html = StockChild::where('id',$request->serial_id)->value('price');
        echo $html;
    }

    public function deletesochild($id)
    {
        $data = SoChild::where('id',$id)->delete();
        if($data)
        {
            return response()->json(['status'=>'success']);
        }else
        {
            return response()->json(['status'=>'error']);
        }
    }
}
