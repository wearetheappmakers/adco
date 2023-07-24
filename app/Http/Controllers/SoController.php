<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\So;
use App\SoChild;
use App\User;
use App\Customer;
use App\Category;
use App\Product;
use Carbon\Carbon;
use App\Discount;
use App\StockChild;
use App\Bsr;

use URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use DataTables;
use Auth;
use PDF;


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

             ->addColumn('bsr_status', function ($row) {
                $btn = '';
                $bsr = Bsr::where('so_id',$row->id)->first();
                if($bsr)
                {
                     if(!($row->type == 1))
                     {

                        if($row->brs_status == 2)
                        {
                            $btn = '<select class="form-control" disabled><option value="1"';
                        }
                        else
                        {
                            $btn = '<select class="form-control" onchange="bsrstatus(this,'.$row->id.')"><option value="1"';
                        }

                        $selected = '';
                        if($row->brs_status == 1)
                        {
                            $selected = 'selected';
                        }
                        $btn .= $selected.'>Pending</option><option value="2" ';
                        $selected = '';
                        if($row->brs_status == 2)
                        {
                            $selected = 'selected';
                        }
                        $btn .= $selected.'>Completed</option></select>';
                    }
                    else
                    {
                        $btn = '';
                    }
                }
                else
                {
                    $btn = '';
                }
               

                    return $btn;


            })

             ->addColumn('customer_id', function ($row) {
                if($row->customer_id)
                {
                $btn = $row->customers->name;

                }
                else
                {
                    $btn = '';
                }
                return $btn;
            })

            ->rawColumns(['action','status','customer_id','bsr_status'])
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
        $data['discount'] = Discount::get();
        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {

         // $arr = [];
        // foreach ($request->serial_id as $keys => $values)
        // {
        //     $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->first();
        //     if(isset($child_data))
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     $check = in_array($values,$arr);
        //     if($check)
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     array_push($arr,$values);
        // }
        // $arr = [];
            $arr = [];
            foreach ($request->serial_id as $keys => $values)
            {
                $child_data = SoChild::where('serial_id',$values)->value('serial_id');
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
        // foreach ($request->serial_id as $keys => $values)
        // { 
        //     $child = SoChild::where('serial_id',$values)->value('serial_id');
        //     if($child)
        //     {
        //         // dd($check);
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     array_push($arr,$values);
        // }

        
        // foreach ($request->serial_id as $keys => $values)
        // {
        //     $check = in_array($values,$arr);
        //     if($check)
        //     {
        //         // dd($check);
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     array_push($arr,$values);
        // }


         


        if($request->type == 2)
        {
            if($request->foc_serial_id)
            {

                $arr = [];
                 foreach ($request->foc_serial_id as $keys => $values)
                 {
                    $child_data = SoChild::where('return_serial_id',$values)->value('return_serial_id');
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
            }
            if(isset($request->foc_new_serial_id))
            {
                $arr = [];
                 foreach ($request->foc_new_serial_id as $keys => $values)
                 {
                    $child_data = SoChild::where('serial_id',$values)->value('serial_id');
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
            }
            
         //    $arr = [];
         //    foreach ($request->foc_serial_id as $keys => $values)
         //    {
         //        $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
         //                // dd($child);
         //        if($child)
         //        {
         //         return response()->json(['status' => 'duplicate_serial']);
         //     }
         //     array_push($arr, $child);
         // }
        }
        if($request->type == 3)
        {
            if($request->pro_old_serial_id)
            {
                $arr = [];
                foreach ($request->pro_old_serial_id as $keys => $values)
                {
                    $child_data = SoChild::where('return_serial_id',$values)->value('return_serial_id');
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
            }
            if(isset($request->pro_new_serial_id))
            {
                 $arr = [];
                foreach ($request->pro_new_serial_id as $keys => $values)
                {
                    $child_data = SoChild::where('serial_id',$values)->value('serial_id');
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
            }
            
           //   $arr = [];
           //   foreach ($request->pro_old_serial_id as $keys => $values)
           //   {
           //      $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
           //                  // dd($child);
           //      if($child)
           //      {
           //         return response()->json(['status' => 'duplicate_serial']);
           //     }
           //     array_push($arr, $child);
           // }
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
        $salesorder->type = $request->type;
        $salesorder->order_no = $request->order_no;
        $salesorder->payment_mode = $request->payment_mode;
        $salesorder->date_of_sale = $request->date_of_sale;
        $salesorder->replace_date = $request->replace_date;
        $salesorder->vehicle_no = $request->vehicle_no;
        $salesorder->remarks = $request->remarks;
        // dd($salesorder);
        $salesorder->total = $request->total;
        $salesorder->save();

       
        if($request->type == 1)
        {

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
        }

      
        else if($request->type == 2)
        {
            if($request->foc_category_id)
            {
                foreach ($request->foc_category_id as $key => $value) 
                {
                    if ($value != '') 
                    {
                      
                        $edu = new SoChild();
                        $edu->so_id = $salesorder->id;
                        $edu->category_id = $value;
                        $edu->product_id = $request->foc_product_id[$key];
                        $edu->serial_id = $request->foc_new_serial_id[$key];
                        $edu->return_serial_id = $request->foc_serial_id[$key];
                        $edu->save();
                    } 
                }

                // $stock = StockChild::where('id',$request->foc_serial_id[$key])->first();
                // $stock->replaced = 1;
                // $stock->save();
               
            }
        }

        else if($request->type == 3)
        {
            if($request->pro_category_id)
            {
                foreach ($request->pro_category_id as $key => $value) 
                {
                    if ($value != '') 
                    {
                       
                        $edu = new SoChild();
                        $edu->so_id = $salesorder->id;
                        $edu->category_id = $value;
                        $edu->product_id = $request->pro_product_id[$key];
                        $edu->serial_id = $request->pro_new_serial_id[$key];
                        $edu->price = $request->pro_old_price[$key];

                        $edu->date_of_sale = $request->pro_dop[$key];
                        $edu->return_serial_id = $request->pro_old_serial_id[$key];
                        $edu->discount = $request->pro_discount_id[$key];
                        $edu->discount_amount = $request->pro_discount_amount[$key];
                        $edu->amount = $request->pro_amount[$key];
                        // dd($edu);
                        $edu->save();
                    } 
                }

                // $stock = StockChild::where('id',$request->pro_old_serial_id[$key])->first();
                // $stock->replaced = 1;
                // $stock->save();
               
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
        // $arr = [];
        // foreach ($request->serial_id as $keys => $values)
        // {
        //     $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->first();
        //     if(isset($child_data))
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     $check = in_array($values,$arr);
        //     if($check)
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     array_push($arr,$values);
        // }
            if($request->type == 1)
            {

                $arr = [];
                if($request->serial_id)
                {
                // dd($request->serial_id);
                    foreach ($request->serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->value('serial_id');
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
                }

                if($request->old_serial_id)
                {
                    foreach ($request->old_serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('serial_id',$values)->where('so_id','!=',$id)->first();

                    
                        if(isset($child_data))
                        {
                            return response()->json(['status' => 'duplicate_serial']);
                        }
                        $check = in_array($values,$arr);
                        // dd($check);
                        if($check)
                        {
                            return response()->json(['status' => 'duplicate_serial']);
                        }
                        array_push($arr,$values);
                    }
                }
            }

            if($request->type == 2)
            {
                // dd($request->type == 2);
                if(isset($request->foc_serial_id))
                {
                    // dd($request->foc_serial_id);

                    $arr = [];
                    foreach ($request->foc_serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('return_serial_id',$values)->where('so_id',$id)->value('return_serial_id');
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
                }
                if(isset($request->foc_new_serial_id))
                {
                    // dd($request->foc_new_serial_id);
                    $arr = [];
                    foreach ($request->foc_new_serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->value('serial_id');
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
                }

                 if(isset($request->edit_foc_new_serial_id))
                {
                    // dd($request->edit_foc_new_serial_id);
                    $arr = [];
                    foreach ($request->edit_foc_new_serial_id as $keys => $values)
                    {

                        $child_data = SoChild::where('serial_id',$values)->where('so_id','!=',$id)->value('serial_id');
                        // dd($child_data);
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
                }

                if(isset($request->edit_foc_serial_id))
                {
                    // dd($request->edit_foc_serial_id);
                    $arr = [];
                    foreach ($request->edit_foc_serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('return_serial_id',$values)->where('so_id','!=',$id)->value('return_serial_id');
                        // dd($child_data);
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
                }

         //    $arr = [];
         //    foreach ($request->foc_serial_id as $keys => $values)
         //    {
         //        $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
         //                // dd($child);
         //        if($child)
         //        {
         //         return response()->json(['status' => 'duplicate_serial']);
         //     }
         //     array_push($arr, $child);
         // }
            }

            if($request->type == 3)
            {
                if(isset($request->pro_old_serial_id))
                {
                    $arr = [];
                    foreach ($request->pro_old_serial_id as $keys => $values)
                    {
                        $child_data = SoChild::where('return_serial_id',$values)->where('so_id',$id)->value('return_serial_id');
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
                }
                if(isset($request->pro_new_serial_id))
                {
                   $arr = [];
                   foreach ($request->pro_new_serial_id as $keys => $values)
                   {
                    $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->value('serial_id');
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
            }

                 if(isset($request->old_pro_new_serial_id))
                {
                   $arr = [];
                   foreach ($request->old_pro_new_serial_id as $keys => $values)
                   {
                    $child_data = SoChild::where('serial_id',$values)->where('so_id','!=',$id)->value('serial_id');
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
            }

             if(isset($request->old_pro_serial_id))
                {
                   $arr = [];
                   foreach ($request->old_pro_serial_id as $keys => $values)
                   {
                    $child_data = SoChild::where('return_serial_id',$values)->where('so_id','!=',$id)->value('return_serial_id');
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
            }
            
           //   $arr = [];
           //   foreach ($request->pro_old_serial_id as $keys => $values)
           //   {
           //      $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
           //                  // dd($child);
           //      if($child)
           //      {
           //         return response()->json(['status' => 'duplicate_serial']);
           //     }
           //     array_push($arr, $child);
           // }
        }


        
       

        $salesorder = So::where('id',$id)->first();
        // if(Auth::user()->role == 1){
        //     $salesorder->branch_id = $request->branch_id;
        // } elseif (Auth::user()->role == 2){
        //     $salesorder->branch_id = Auth::user()->id;
        // }
        // elseif (Auth::user()->role == 3){
        //     $salesorder->branch_id = Auth::user()->branch_id;
        // }
        // $salesorder->customer_id = $request->customer_id;
        $salesorder->type = $request->type;
        // $salesorder->order_no = $request->order_no;
        $salesorder->payment_mode = $request->payment_mode;
        $salesorder->date_of_sale = $request->date_of_sale;
        $salesorder->replace_date = $request->replace_date;
        $salesorder->vehicle_no = $request->vehicle_no;
        $salesorder->remarks = $request->remarks;
        // dd($salesorder);
        if($salesorder->type == 1)
        {

        $salesorder->total = $request->total;
        }
        elseif ($salesorder->type == 3) {
             $salesorder->total = $request->pro_total_amount;
        }
        // dd($salesorder);
        $salesorder->save();

       
        if($request->type == 1)
        {
            if($request->old_category_id)
            {
                // dd($request->edit_productcategory_id);
                foreach ($request->old_category_id as $key => $value) {
                    {
                        if($value != '')
                        {


                                // dd($value);
                            $pro_child['so_id'] = $id;
                            $pro_child['category_id'] = $value;
                            $pro_child['product_id'] = $request->old_product_id[$key];
                                // dd($pro_child);
                            $pro_child['serial_id'] = $request->old_serial_id[$key];

                            $pro_child['price'] = $request->old_price[$key];


                    // dd($pro_child);
                            // dd($request->edit_hidden_id[$key]);
                            $pro_child1 = SoChild::where('id',$request->edit_hidden_id[$key])->update($pro_child);

                        }
                    }
                }
            }

            if($request->category_id)
            {
                // dd($request->category_id);
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
        }

        else if($request->type == 2)
        {
           if($request->edit_foc_category_id)
           {
                // dd($request->edit_productcategory_id);
            foreach ($request->edit_foc_category_id as $key => $value) {
                {
                    if($value != '')
                    {
                    
                        $pro_child['so_id'] = $id;
                        $pro_child['category_id'] = $value;
                        $pro_child['product_id'] = $request->edit_foc_product_id[$key];
                                // dd($pro_child);
                        $pro_child['serial_id'] = $request->edit_foc_new_serial_id[$key];
                      
                        $pro_child['return_serial_id'] = $request->edit_foc_serial_id[$key];
                       

                    // dd($pro_child);
                            // dd($request->edit_hidden_id[$key]);
                        $pro_child1 = SoChild::where('id',$request->edit_hidden_id[$key])->update($pro_child);

                    }
                }
            }
        }
            if($request->foc_category_id)
            {
                foreach ($request->foc_category_id as $key => $value) 
                {
                    if ($value != '') 
                    {
                  
                        $edu = new SoChild();
                        $edu->so_id = $salesorder->id;
                        $edu->category_id = $value;
                        $edu->product_id = $request->foc_product_id[$key];
                        $edu->serial_id = $request->foc_new_serial_id[$key];
                        $edu->return_serial_id = $request->foc_serial_id[$key];
                        $edu->save();
                    }

                    // $stock = StockChild::where('id',$request->foc_serial_id[$key])->first();
                    // $stock->replaced = 1;
                    // $stock->save(); 
                }
            }
        }

         else if($request->type == 3)
        {
         if($request->old_pro_category_id)
         {
                // dd($request->edit_productcategory_id);
            foreach ($request->old_pro_category_id as $key => $value) {
                {
                    if($value != '')
                    {
                     //    $arr = [];
                     //    foreach ($request->old_pro_serial_id as $keys => $values)
                     //    {
                     //        $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
                     //    // dd($child);
                     //        if($child)
                     //        {
                     //         return response()->json(['status' => 'duplicate_serial']);
                     //     }
                     //     array_push($arr, $child);
                     // }
                                // dd($value);
                        $pro_child['so_id'] = $id;
                        $pro_child['category_id'] = $value;
                        $pro_child['product_id'] = $request->old_pro_product_id[$key];
                                // dd($pro_child);
                        $pro_child['serial_id'] = $request->old_pro_new_serial_id[$key];
                        $pro_child['price'] = $request->old_pro_price[$key];
                        $pro_child['date_of_sale'] = $request->old_pro_dop[$key];
                        $pro_child['return_serial_id'] = $request->old_pro_serial_id[$key];
                        $pro_child['discount'] = $request->old_pro_discount_id[$key];
                        $pro_child['discount_amount'] = $request->old_pro_discount_amount[$key];
                        $pro_child['amount'] = $request->old_pro_amount[$key];
                
                    // dd($pro_child);
                            // dd($request->edit_hidden_id[$key]);
                        $pro_child1 = SoChild::where('id',$request->edit_hidden_id[$key])->update($pro_child);

                    }
                }
            }
        }
            if($request->pro_category_id)
            {
                foreach ($request->pro_category_id as $key => $value) 
                {
                    if ($value != '') 
                    {

                     $arr = [];
                     foreach ($request->pro_old_serial_id as $keys => $values)
                     {
                        $child = SoChild::where('return_serial_id',$values)->value('return_serial_id');
                        // dd($child);
                        if($child)
                        {
                           return response()->json(['status' => 'duplicate_serial']);
                       }
                       array_push($arr, $child);
                   }
                        $edu = new SoChild();
                        $edu->so_id = $salesorder->id;
                        $edu->category_id = $value;
                        $edu->product_id = $request->pro_product_id[$key];
                        $edu->serial_id = $request->pro_new_serial_id[$key];
                        $edu->price = $request->pro_old_price[$key];

                        $edu->date_of_sale = $request->pro_dop[$key];
                        $edu->return_serial_id = $request->pro_old_serial_id[$key];
                        $edu->discount = $request->pro_discount_id[$key];
                        $edu->discount_amount = $request->pro_discount_amount[$key];
                        $edu->amount = $request->pro_amount[$key];
                        // dd($edu);
                        $edu->save();
                    } 
                }

                // $stock = StockChild::where('id',$request->pro_old_serial_id[$key])->first();
                // $stock->replaced = 1;
                // $stock->save();
               
            }

        }
        // $data = $request->all();
        // // dd($data);
        // unset($data['_method'],$data['_token'],$data['branch_id'],$data['customer_id'],$data['hidden_id'],$data['old_price'],$data['category_id'],$data['product_id'],$data['serial_id'],$data['price'],$data['old_category_id'],$data['old_product_id'],$data['old_serial_id'],$data['old_price']);
        
        // $arr = [];
        // foreach ($request->serial_id as $keys => $values)
        // {
        //     $child_data = SoChild::where('serial_id',$values)->where('so_id',$id)->first();
        //     if(isset($child_data))
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     $check = in_array($values,$arr);
        //     if($check)
        //     {
        //         return response()->json(['status' => 'duplicate_serial']);
        //     }
        //     array_push($arr,$values);
        // }

        // $datas = So::where('id', $id)->update($data);


        // if(isset($request->category_id))
        // {
        //     foreach ($request->category_id as $key => $value) 
        //     {
        //         if ($value != '') 
        //         {
        //             $edu = new SoChild();
        //             $edu->so_id = $id;
        //             $edu->category_id = $value;
        //             $edu->product_id = $request->product_id[$key];
        //             $edu->serial_id = $request->serial_id[$key];
        //             $edu->price = $request->price[$key];
        //             $edu->save();
        //         } 
        //     }
        // }


        if($salesorder)
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

              foreach($so_child as $child){

                $data = StockChild::where('serial_no',$child->return_serial_id)->get();

                foreach($data as $key=>$value)
                {
                    $value->update(['return_id'=>1]); 
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

        $data1 = Product::where('category_id',$request->old_category_id)->get();
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->name."</option>";
        }

         return response()->json(['data'=>$html ,'data1'=>$html1]);

    }

     public function newproduct(Request $request)
    {
        $data = Product::where('category_id',$request->foc_category_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

         $data1 = Product::where('category_id',$request->edit_foc_category_id)->get();
         // dd($data1);
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->name."</option>";
        }

        return response()->json(['data'=>$html , 'data1'=>$html1]);

    }

    public function getserial(Request $request)
    {
        $data = StockChild::where('used',0)->where('product_id',$request->product_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

         $data1 = StockChild::where('used',0)->where('product_id',$request->old_product_id)->get();
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

        return response()->json(['data'=>$html , 'data1'=>$html1]);

    }

     public function oldserial(Request $request)
    {
        $data = StockChild::where('used',1)->where('product_id',$request->foc_product_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->serial_no."></option>";
        }

         $data3 = StockChild::where('used',1)->where('product_id',$request->edit_foc_product_id)->get();
        $html3 = "<option value=''>Select</option>";
        foreach ($data3 as $key => $value) {
            $html3 .= "<option value=".$value->serial_no."></option>";
        }

         $data1 = StockChild::where('used',0)->where('product_id',$request->foc_product_id)->get();
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

         $data4 = StockChild::where('used',0)->where('product_id',$request->edit_foc_product_id)->get();
        $html4 = "<option value=''>Select</option>";
        foreach ($data4 as $key => $value) {
            $html4 .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

         return response()->json(['data'=>$html , 'data1'=>$html1,'data3'=>$html3,'data4'=>$html4]);

    }

    public function getprice(Request $request)
    {
        $html = StockChild::where('id',$request->serial_id)->value('price');
        $html1 = StockChild::where('id',$request->old_serial_id)->value('price');
        return response()->json(['data'=>$html , 'data1'=>$html1]);
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



    public function progetproduct(Request $request)
    {
        $data = Product::where('category_id',$request->pro_category_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

        $data1 = Product::where('category_id',$request->old_pro_category_id)->get();
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->name."</option>";
        }

         return response()->json(['data'=>$html, 'data1'=>$html1]);
    }

    public function progetserial(Request $request)
    {
        $data = StockChild::where('used',1)->where('return_id',0)->where('product_id',$request->pro_product_id)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->serial_no."></option>";
        }   

        $data3 = StockChild::where('used',1)->where('return_id',0)->where('product_id',$request->old_pro_product_id)->get();
        $html3 = "<option value=''>Select</option>";
        foreach ($data3 as $key => $value) {
            $html3 .= "<option value=".$value->serial_no."></option>";
        }    

        $data1 = StockChild::where('used',0)->where('product_id',$request->pro_product_id)->get();
        $html1 = "<option value=''>Select</option>";
        foreach ($data1 as $key => $value) {
            $html1 .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

         $data4 = StockChild::where('used',0)->where('product_id',$request->old_pro_product_id)->get();
        $html4 = "<option value=''>Select</option>";
        foreach ($data4 as $key => $value) {
            $html4 .= "<option value=".$value->id.">".$value->serial_no."</option>";
        }

        $html2 = StockChild::where('product_id',$request->pro_old_serial_id)->value('price');

        return response()->json(['data'=>$html, 'data1'=>$html1, 'data2'=>$html2, 'data3' => $html3, 'data4'=>$html4]);
    }


    public function getdop(Request $request)
    {
        $old_serial_id = StockChild::where('serial_no',$request->pro_old_serial_id)->first();
        $child = SoChild::where('serial_id',$old_serial_id->id)->first();
        // dd($request->pro_old_serial_id);
        $html = So::where('id',$child->so_id)->value('date_of_sale');        
        $html1 = StockChild::where('serial_no',$request->pro_old_serial_id)->value('price');

        $product = Product::where('id',$child->product_id)->first();
        $main = So::where('id',$child->so_id)->first();
        $fromDate = Carbon::parse($main->date_of_sale);
        $toDate = Carbon::parse($request->replace_date);

         $days = $toDate->diffInDays($fromDate);
         $discount = Discount::get();
         foreach ($discount as $key => $value) {
            $dis = Discount::where('id',$value->id)->first();
            $dayss = $dis->name * 365;
            if($days <= $dayss)
            {
                $html2 = Discount::where('id',$value->id)->value('value');
                if(!(empty($html2)))
                {
                    break;
                }

            
            }

            else
            {
                $html2 = '';
            }


            
         }



         // dd($days);

        // $html2 = Discount::where('name',$product->warranty_year)->value('value');
      



        return response()->json(['data'=>$html, 'data1'=>$html1,'data2'=>$html2]);

    }

    public function editgetdop(Request $request)
    {
        $child = SoChild::where('serial_id',$request->old_pro_serial_id)->first();
        $html = So::where('id',$child->so_id)->value('date_of_sale');        
        $html1 = StockChild::where('id',$request->old_pro_serial_id)->value('price');

        $product = Product::where('id',$child->product_id)->first();
        $main = So::where('id',$child->so_id)->first();
        $fromDate = Carbon::parse($main->date_of_sale);
        $toDate = Carbon::parse($request->replace_date);

         $days = $toDate->diffInDays($fromDate);
         $discount = Discount::get();
         foreach ($discount as $key => $value) {
            $dis = Discount::where('id',$value->id)->first();
            $dayss = $dis->name * 365;
            if($days <= $dayss)
            {
                $html2 = Discount::where('id',$value->id)->value('value');
                if(!(empty($html2)))
                {
                    break;
                }

            
            }

            else
            {
                $html2 = '';
            }


            
         }


         
         // dd($days);

        // $html2 = Discount::where('name',$product->warranty_year)->value('value');
      



        return response()->json(['data'=>$html, 'data1'=>$html1,'data2'=>$html2]);

    }

    public function pdf(Request $request)
    {
        $data = So::where('id',$request->id)->first();
        $pdf = PDF::setOptions(['logOutputFile' => storage_path('logs/log.htm'), 'tempDir' => storage_path('logs/'), 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('bsrpdf')->setPaper('A4', 'portrait');
        // $pdf->save('public/pdf/'.$data->id.'.pdf');
        return $pdf->download('BSR.pdf');
    }

    public function bsr($id)
    {
        $data['data'] = So::where('id',$id)->first();
        $data['customer'] = Customer::get();
        $data['bsr'] = Bsr::where('so_id',$id)->first();
         return view('salesorder.bsr')->with($data);
    }

    public function bsr_status(Request $request)
    {
         $change_status = So::where('id',$request->id)->first();
       

            $change_status->bsr_status = $request->status;
            if($request->status == 2)
            {
                $so_child = SoChild::where('so_id',$change_status->id)->get();
                // dd($so_child);
           

                foreach($so_child as $child){

                    $data = StockChild::where('id',$child->return_serial_id)->get();

                    foreach($data as $key=>$value)
                    {
                        $stock = StockChild::where('id',$value->id)->first();
                        // dd($stock);
                        $stock_child = new StockChild();
                        $stock_child->stock_id = $stock->stock_id;
                        $stock_child->user_id = $stock->user_id;
                        $stock_child->category_id = $stock->category_id;
                        $stock_child->product_id = $stock->product_id;
                        $stock_child->price = $stock->price;
                        $stock_child->serial_no = $request->completed_serial_no;
                        // dd($stock_child->serial_no);

                        $value->update(['replaced'=>1]); 
                    }
                }
            }
            $change_status->save();
          
        
        

        if($change_status) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function completed(Request $request)
    {
       $data1 = So::where('id',$request->id)->first();
       // dd($data1);

        if($request->status == 2)
            {
                 $bsr = Bsr::where('so_id',$data1->id)->first();
                 // $stock = StockChild::where('id',$bsr->part_no)->value('serial_no');
                 // dd($bsr->part_no);
                
                 $so_child = SoChild::where('return_serial_id',$bsr->part_no)->first();
                  $stock = StockChild::where('serial_no',$bsr->part_no)->first();
                // $so_child = SoChild::where('so_id',$data1->id)->get();

                 // dd($stock);
                 $stock_child = new StockChild();
                    
                   if($request->completed_serial_no)
                   {
                        $check = StockChild::where('serial_no',$request->completed_serial_no)->value('serial_no');
                        if($check)
                        {
                            return response()->json(['status' => 'duplicate_serial']);
                        }
                   }
                  
                 $stock_child->stock_id = $stock->stock_id;
                 $stock_child->user_id = $stock->user_id;
                 $stock_child->category_id = $stock->category_id;
                 $stock_child->product_id = $stock->product_id;
                 $stock_child->price = $stock->price;
                 $stock_child->serial_no = $request->completed_serial_no;
                 $stock_child->save();

                 $stock->replaced = $stock_child->id;
                 $stock->save();

                 $so_child->replace_serial_id = $stock_child->id;
                 $so_child->save();
             }
           

       //          foreach($so_child as $child){

       //              $data = StockChild::where('serial_no',$child->return_serial_id)->get();

       //              foreach($data as $key=>$value)
       //              {
       //                  $stock = StockChild::where('id',$value->id)->first();
       // // dd($so_child);
       //                  $stock_child = new StockChild();
       //                  $stock_child->stock_id = $stock->stock_id;
       //                  $stock_child->user_id = $stock->user_id;
       //                  $stock_child->category_id = $stock->category_id;
       //                  $stock_child->product_id = $stock->product_id;
       //                  $stock_child->price = $stock->price;
       //                  $stock_child->serial_no = $request->completed_serial_no;
       //                  $stock_child->save();

       //                  $value->update(['replaced'=>$stock_child->id]); 
                       

       //                  $child = SoChild::where('return_serial_id',$value->serial_no)->first();
       //                  // dd($stock_child);
       //                  $child->replace_serial_id = $stock_child->id;
       //                  $child->save();
       //              }
       //          }
       //      }
            $data1->brs_status = $request->status;
            // dd($data1->brs_status);
            $data1->save();
                        // dd($child);
            $notification = array(
                'message' => 'Status Change successfully!',
                'alert-type' => 'success'
            );

            if($data1) {
                return back()->with($notification);
            } else {
                return back()->with('error');
            }
      
      
    }

    public function bsr_store(Request $request)
    {
        $bsr = Bsr::where('so_id',$request->so_id)->first();
        if(isset($bsr))
        {
            $param = $request->all();
            unset($param['_method'],$param['_token']);
            $bsr = Bsr::where('so_id',$request->so_id)->update($param);
           
        }
        else
        {
            $param = $request->all();
            $bsr = Bsr::Create($param);
        }

         if($bsr) {
            return response()->json(['status' => 'success']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function download($id)
    {
        $child = SoChild::where('id',$id)->first();
        // dd($child);
      
        $pdf = PDF::setOptions(['logOutputFile' => storage_path('logs/log.htm'), 'tempDir' => storage_path('logs/'), 'isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('qrcode')->setPaper('A4', 'portrait');
        // $pdf->save('public/pdf/'.$data->id.'.pdf');
        return $pdf->download('qrcode.pdf');

        // $image = '<img src="data:image/png;base64, {!! base64_encode(QrCode::format("png")->size(100)->generate()) !!} ">
        // <p>Scan me to return to the original page.</p>';
    }

}
