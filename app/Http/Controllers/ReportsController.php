<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StockChild;
use App\Category;
use App\User;
use App\SoChild;
use App\So;
use App\Attendance;
use App\Regularize;
use App\Product;
use DataTables;
use Auth;
use Excel;
use App\Exports\ReplaceStockReport;
use App\Exports\ReturnStockReport;
use App\Exports\InveStockExport;

class ReportsController extends Controller
{
    public function returnstock(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
                $query = StockChild::with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = StockChild::where('user_id',Auth::user()->id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){
                $query = StockChild::where('user_id',Auth::user()->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            }
            if($request->branch_id)
            {
                $query = $query->where('user_id',$request->branch_id)->latest();

            }
            if($request->category_id)
            {
                $query = $query->where('category_id',$request->category_id)->latest();

            }
            if($request->product_id)
            {
                $query = $query->where('product_id',$request->product_id)->latest();

            } 
             if($request->from_date || $request->to_date ){
              $from = date('Y-m-d' , strtotime($request->from_date));
              $to = date('Y-m-d' , strtotime($request->to_date));

            // $query = KabirPurchaseorder::whereBetween('created_at',[$request->from_date, $request->to_date])->get();
              $query = StockChild::whereDate('created_at','>=',$from)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','<=',$to)->get();

               if($request->branch_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('user_id',$request->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }


              if($request->category_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('category_id',$request->category_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }
             if($request->product_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('product_id',$request->product_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }

        }
            return Datatables::of($query)

            ->addColumn('action', function ($row) {         
                $btn = '<a style="background: white;" href="'.route('returnstock.view', $row->id).'" title="view details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>';
                return $btn;
            })

             ->addColumn('new_serial_no', function ($row) {
                $btn = '';
                
                $child = SoChild::where('return_serial_id',$row->serial_no)->first();
                $btn = StockChild::where('id',$child->serial_id)->value('serial_no');
                return $btn;
            })


            ->rawColumns(['category','action','new_serial_no'])
            ->make(true);
        }
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        return view('reports.returnstock')->with($data);
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

     public function replacestock(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
                $query = StockChild::with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = StockChild::where('user_id',Auth::user()->id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){
                $query = StockChild::where('user_id',Auth::user()->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->orderBy('id','DESC')->latest();
            }
            if($request->branch_id)
            {
                $query = $query->where('user_id',$request->branch_id)->latest();

            }
            if($request->category_id)
            {
                $query = $query->where('category_id',$request->category_id)->latest();

            }
            if($request->product_id)
            {
                $query = $query->where('product_id',$request->product_id)->latest();

            } 
            if($request->from_date || $request->to_date ){
              $from = date('Y-m-d' , strtotime($request->from_date));
              $to = date('Y-m-d' , strtotime($request->to_date));

            // $query = KabirPurchaseorder::whereBetween('created_at',[$request->from_date, $request->to_date])->get();
              $query = StockChild::whereDate('created_at','>=',$from)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','<=',$to)->get();

               if($request->branch_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('user_id',$request->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }


              if($request->category_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('category_id',$request->category_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }
             if($request->product_id){

                // $query = KabirPurchaseorder::where('vender',$request->vender)->whereBetween('created_at',[$request->from_date, $request->to_date])->get();
                $query = StockChild::where('product_id',$request->product_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->where('return_id',1)->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }

        }
            return Datatables::of($query)

            ->addColumn('action', function ($row) {         
                $btn = '<a style="background: white;" href="'.route('returnstock.view', $row->id).'" title="view details" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>';
                return $btn;
            })

             ->addColumn('replaced', function ($row) {
               if($row->replaced)
               {

                $btn = StockChild::where('id',$row->replaced)->value('serial_no');
               }
               else
               {
                $btn = '';
               }
                
                
                return $btn;
            })


            ->rawColumns(['category','action','replaced'])
            ->make(true);
        }
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        return view('reports.replacestock')->with($data);
    }

    public function replacereportexcel(Request $request)
    {
       $param = $request->all();
      // dd($param);
       return Excel::download(new ReplaceStockReport($param), 'replace-stock-report.xlsx');
   }

    public function returnstockexcel(Request $request)
    {
       $param = $request->all();
      // dd($param);
       return Excel::download(new ReturnStockReport($param), 'return-stock-report.xlsx');
   }

   public function invereport(Request $request)
   {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
            $query = StockChild::with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
            $query = StockChild::where('user_id',Auth::user()->id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){
            $query = StockChild::where('user_id',Auth::user()->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->orderBy('id','DESC')->latest();
            } 

            if($request->branch_id)
            {
                $query = $query->where('user_id',$request->branch_id)->latest();

            }
            if($request->category_id)
            {
                $query = $query->where('category_id',$request->category_id)->latest();

            }
            if($request->product_id)
            {
                $query = $query->where('product_id',$request->product_id)->latest();

            } 

            if($request->used == 2)
            {
                $query = $query->latest();
            } elseif($request->used ==0) {
                $query = $query->where('used',0)->latest();
            } elseif($request->used == 1) {
                $query = $query->where('used',1)->latest();
            }

            if($request->from_date || $request->to_date ){
              $from = date('Y-m-d' , strtotime($request->from_date));
              $to = date('Y-m-d' , strtotime($request->to_date));


              $query = StockChild::whereDate('created_at','>=',$from)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','<=',$to)->get();

              if($request->branch_id){

                $query = StockChild::where('user_id',$request->branch_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }


            if($request->category_id){


                $query = StockChild::where('category_id',$request->category_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }
            if($request->product_id){


                $query = StockChild::where('product_id',$request->product_id)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }

             if($request->used == 1){


                $query = StockChild::where('used',1)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }

            if($request->used == 0){


                $query = StockChild::where('used',0)->with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }
            if($request->used == 2){


                $query = StockChild::with('stocks','stocks.products','stocks.categorys','stocks.users')->whereDate('created_at','>=',$from)->whereDate('created_at','<=',$to)->get();
            }

        }
            return Datatables::of($query)

            ->editColumn('used',function($row){
                if($row->used == 1){
                $btn = 'Yes';
            }
                elseif($row->used == 0){
                    $btn = 'No';
                }
                return $btn;
            })

            ->addColumn('date', function ($row) {
                $ac = date('d-m-Y',strtotime($row->stocks->created_at));
                return $ac;
            })

            ->addColumn('replaced', function ($row) {
                if($row->replaced){
                $ac = StockChild::where('id',$row->replaced)->value('serial_no');
                } else {
                    $ac = '';
                }
                return $ac;
            })


            ->rawColumns(['category','used','replaced'])
            ->make(true);
        }
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        return view('reports.invereport')->with($data);
    }


    public function inveeportexcel(Request $request)
    {
       $param = $request->all();
      // dd($param);
       return Excel::download(new InveStockExport($param), 'inventory_report.xlsx');
   }

   public function reportserialno()
   {
        return view('reports.reportserialno');
   }

  public function getdata(Request $request)
  {
   
        $stockchild = StockChild::where('id',$request->serial_no)->first();
        // dd($stockchild);
        $salesorderchild = SoChild::where('serial_id',$stockchild->id)->first();
        // dd($salesorderchild);
       
      
        
       
        $data['data'] = '';
        
           
            $data['data'] .= '<div class="master_clone_div" id="orderwise">
            <div class="row">
            ';
           
            $data['data'] .= '
            <label><h4>Serial No:&nbsp;&nbsp; '. $stockchild->serial_no.'</h4></label><br/>
            </div>
            <style>
            table {
              border-collapse: collapse;
              width: 50%;
          }



          th, td {
              text-align: left;
              padding: 8px;
          }

          tr:nth-child(even) {
              background-color: #D6EEEE;
          }
            </style>
             <div class="row">
            <table>
            <tr >
            <th >Serial No:</th>
            <th >'.$stockchild->serial_no.'</th>
            </tr>
            <tr >
            <td >Category Name:</td> 
            <td>'.$stockchild->category->name.'</td>
            </tr>
            <tr >
            <td>Product Name:</td>
            <td >'.$stockchild->product->name.'</td>
            </tr>
            <tr >
            <td >Price:</td>
            <td >'.$stockchild->price.'</td>
            </tr>
            <tr >
            <td >Used:</td>
            <td>'.$stockchild->used.'</td>
            </tr>

            </table>
            
            </div>
            <br/>';
            if(isset($salesorderchild))
            {
                 $salesorder = So::where('id',$salesorderchild->so_id)->first();
                 if($salesorder->type == 1)
                 {
                   $data['data'] .= ' <div class="row">
                   <label><h4>Direct Sales</h4>

                   </div>
                   <div class="row">
                   <table>
                   <tr>
                   <th>SalesOrder Id:</th>
                   <td>'.$salesorderchild->so_id.'</td>
                   </tr>
                   <tr>
                   <th>Customer Name:</th>
                   <td>'.$salesorder->customers->name.'</td>
                   </tr>
                   <tr>
                   <th>Date Of Sale:</th>
                   <td>'.$salesorder->date_of_sale.'</td>
                   </tr>


                   </table>

                   </div><br/>';
                 }
                
                  
               }


           

            if(isset($salesorderchild))
            {

                      $salesorderchild_foc = SoChild::where('return_serial_id',$stockchild->serial_no)->first();
                        if(isset($salesorderchild_foc))
                        {
                             $salesorder_foc = So::where('id',$salesorderchild_foc->so_id)->first();

                              if($salesorder_foc->type == 2)
                              {
                                 $data['data'] .= '<div class="row">
                                 <label><h4>FOC</h4>

                                 </div>
                                 <div class="row">
                                 <table>
                                 <tr>
                                 <th>SalesOrder Id:</th>
                                 <td>'.$salesorder_foc->id.'</td>
                                 </tr>
                                 <tr>
                                 <th>Customer Name:</th>
                                 <td>'.$salesorder_foc->customers->name.'</td>
                                 </tr>
                                 <tr>
                                 <th>Replace Date:</th>
                                 <td>'.$salesorder_foc->replace_date.'</td>
                                 </tr>
                                 <tr>
                                 <th>Old Serial No:</th>
                                 <td>'.$salesorderchild_foc->return_serial_id.'</td>
                                 </tr>
                                 <tr>
                                 <th>New Serial No:</th>
                                 <td>'.$salesorderchild_foc->stock_childs->serial_no.'</td>
                                 </tr>


                                 </table>

                                 </div>'; 
                             }
                             elseif ($salesorder_foc->type == 3) {
                               $data['data'] .= '<div class="row">
                               <label><h4>Pro Rata Warranty</h4>

                               </div>
                               <div class="row">
                               <table>
                               <tr>
                               <th>SalesOrder Id:</th>
                               <td>'.$salesorder_foc->id.'</td>
                               </tr>
                               <tr>
                               <th>Customer Name:</th>
                               <td>'.$salesorder_foc->customers->name.'</td>
                               </tr>
                               <tr>
                               <th>Replace Date:</th>
                               <td>'.$salesorder_foc->replace_date.'</td>
                               </tr>
                               <tr>
                               <th>Old Serial No:</th>
                               <td>'.$salesorderchild_foc->return_serial_id.'</td>
                               </tr>
                               <tr>
                               <th>New Serial No:</th>
                               <td>'.$salesorderchild_foc->stock_childs->serial_no.'</td>
                               </tr>


                               </table>

                               </div>'; 
                           }
                           if($salesorderchild_foc->replace_serial_id > 0)
                           {
                                $stock = StockChild::where('id',$salesorderchild_foc->replace_serial_id)->first();
                                $replace = SoChild::where('replace_serial_id',$stock->id)->first();
                                // dd($replace);
                                 $data['data'] .= '<br/><div class="row">
                               <label><h4>BSR Replace Serial No</h4>

                               </div>
                               <div class="row">
                               <table>
                               <tr>
                               <th>SalesOrder Id:</th>
                               <td>'.$replace->so_id.'</td>
                               </tr>
                              
                              
                               <th>Old Serial No:</th>
                               <td>'.$replace->return_serial_id.'</td>
                               </tr>
                               <tr>
                               <th>New Serial No:</th>
                               <td>'.$replace->stock_childs->serial_no.'</td>
                               </tr>
                               <tr>
                               <th>Replace Serial No:</th>
                               <td>'.$stock->serial_no.'</td>
                               </tr>


                               </table>

                               </div>'; 
                           }

                        }
                        else
                        {
                            $so_child = SoChild::where('serial_id',$stockchild->id)->first();
                            $so = So::where('id',$so_child->so_id)->first();
                            if($so->type == 2)
                            {
                               $data['data'] .= '<div class="row">
                               <label><h4>FOC</h4>

                               </div>
                               <div class="row">
                               <table>
                               <tr>
                               <th>SalesOrder Id:</th>
                               <td>'.$so->id.'</td>
                               </tr>
                               <tr>
                               <th>Customer Name:</th>
                               <td>'.$so->customers->name.'</td>
                               </tr>
                               <tr>
                               <th>Replace Date:</th>
                               <td>'.$so->replace_date.'</td>
                               </tr>
                               <tr>
                               <th>Old Serial No:</th>
                               <td>'.$so_child->return_serial_id.'</td>
                               </tr>
                               <tr>
                               <th>New Serial No:</th>
                               <td>'.$so_child->stock_childs->serial_no.'</td>
                               </tr>


                               </table>

                               </div>'; 
                           }
                           elseif ($so->type == 3) {
                             $data['data'] .= '<div class="row">
                             <label><h4>Pro Rata Warranty</h4>

                             </div>
                             <div class="row">
                             <table>
                             <tr>
                             <th>SalesOrder Id:</th>
                             <td>'.$so->id.'</td>
                             </tr>
                             <tr>
                             <th>Customer Name:</th>
                             <td>'.$so->customers->name.'</td>
                             </tr>
                             <tr>
                             <th>Replace Date:</th>
                             <td>'.$so->replace_date.'</td>
                             </tr>
                             <tr>
                             <th>Old Serial No:</th>
                             <td>'.$so_child->return_serial_id.'</td>
                             </tr>
                             <tr>
                             <th>New Serial No:</th>
                             <td>'.$so_child->stock_childs->serial_no.'</td>
                             </tr>


                             </table>

                             </div>'; 
                         }
                        }
                       
                       
                     
                
           
             
               }


              
            
        

        
           
                    

             
            
        $data['data'] .= '
            </div>
            </div>';
        
        return response()->json($data);
  }

  public function attendance(Request $request)
  {
      if ($request->ajax())
        {
            if(Auth::user()->role == 1){
                $query = Attendance::with('user')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = Attendance::with('user')->where('branch_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){
                $query = Attendance::with('user')->where('employee_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            }
            if($request->branch_id)
            {
                $query = $query->with('user')->where('branch_id',$request->branch_id)->latest();

            }   
            return Datatables::of($query)

            ->addColumn('action', function ($row) { 
             { 
                $regularize = Regularize::where('attendance_id',$row->id)->first();
                if($row->attendance !== "Present"){
                    if(!$regularize){       
                        $btn = '<a style="background: white;" href="'.route('regularize.create', $row->id).'" title="Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-calendar-3"></i></a> &nbsp; '; 
                    } else {
                     $btn = ''; 
                 }
             } else {
                $btn = ''; 
             }         
            }
            return $btn;
            })

             ->addColumn('date', function ($row) {
                $btn = date('d-m-Y',strtotime($row->date));
                return $btn;
            })

              ->addColumn('branch_id', function ($row) {
                $btn = User::where('id',$row->branch_id)->value('name');
                return $btn;
            })

              ->addColumn('employee_id', function ($row) {
                $btn = User::where('id',$row->employee_id)->value('name');
                return $btn;
            })


            ->rawColumns(['category','action','new_serial_no','date','branch_id','employee_id'])
            ->make(true);
        }
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        $data['category'] = Category::get();
        return view('reports.attendance')->with($data);
  }

  public function regularizecreate(Request $request)
  {
    $data['user'] = User::get();
    $data['data'] = Attendance::where('id', $request->id)->first();
    return view('reports.regularize')->with($data);

  }


  public function storeregularize(Request $request)
  {
    $regularize = Regularize::where('attendance_id',$request->id)->first();

    if(!($regularize))
    {  
        $data = new Regularize();
        $data->attendance_id = $request->id;
        $data->type = $request->type;
        $data->reason = $request->reason;
        $data->save();
    } else {
        $data = Regularize::where('attendance_id',$request->id)->first();
        $data->type = $request->type;
        $data->reason = $request->reason;
        $data->save();
    }

    if($data)
    {
        return response()->json(['status' => 'success']);
    }else
    {
        return response()->json(['status' => 'error']);
    }
  }


  // public function regularizestatus(Request $request)
  //   {

  //       $param['status'] = $request->status;
  //       $change_status = Regularize::where('attendance_id',$request->id)->update($param);
  //       if($change_status)
  //       {
  //           return response()->json(['status' => 'success']);
  //       }
  //       else
  //       {
  //           return response()->json(['status' => 'error']);
  //       }
  //   }



    // public function regularizeindex(Request $request)
    // {
    //     if ($request->ajax())
    //     {
    //         $query = Regularize::with('attendances')->latest();
    //         return Datatables::of($query)

    //         ->addColumn('action', function ($row) { 
    //          { 

    //             if($row->status === "Pending"){       
    //             $btn = '<a style="background: white;" href="'.route('regularize', $row->id).'" title="Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-calendar-3"></i></a> &nbsp;

    //                 <a style="background: white;" href="'.route('regularize', $row->id).'" title="Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>'; 
    //             } else {
    //                $btn = '<a style="background: white;" href="'.route('regularize', $row->id).'" title="Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>'; 
    //             }          
    //         }
    //         return $btn;
    //         })
            
    //         ->addColumn('dropdown', function ($row) {
    //             $regularize = Regularize::where('attendance_id',$row->id)->first();
    //             if($regularize){

    //                 if($regularize->status !== "Pending")
    //                 {
    //                     $btn = '<select class="form-control" disabled><option value="Pending"';
    //                 }
    //                 else
    //                 {
    //                     $btn = '<select class="form-control" onchange="status(this,'.$row->id.')"><option value="Pending"';
    //                 }
    //                 $selected = '';
    //                 if($regularize->status === "Pending" )
    //                 {
    //                     $selected = 'selected';
    //                 }
    //                 $btn .= $selected.'>Pending</option><option value="Approved" ';

    //                 $selected = '';
    //                 if($regularize->status === "Approved" )
    //                 {
    //                     $selected = 'selected';
    //                 }
    //                 $btn .= $selected.'>Approved</option><option value="Reject" ';

    //                 $selected = '';
    //                 if($regularize->status === "Reject")
    //                 {
    //                     $selected = 'selected';
    //                 }
    //                 $btn .= $selected.'>Reject</option></select>';
            
    //                 return $btn;

    //             } else {
    //                 return "Add Regularization Data";
    //             }

    //         })

    //         ->rawColumns(['dropdown','action'])
    //         ->make(true);
    //     }
    //     $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
    //     $data['category'] = Category::get();
    //     return view('reports.regularizeindex')->with($data);
    // }

   
}
