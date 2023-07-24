<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\FranchiseItem;
use App\So;
use App\Stock;
use App\StockChild;
use App\SoChild;
use App\Bsr;


class HomeController extends Controller

{

     public function __construct()
     {
        $this->middleware('auth');
     }


     public function index()
     {
        return view('home');
     }


     public function deleteMultiple(Request $request)
     {
       $table_name = $request->get('table_name');
       $id_array = explode(',', $request->get('id'));
       try {
          if($table_name == 'stocks')
               {
                 $flag = 0;
                 $data = Stock::whereIn('id',$id_array)->first();
                 
                 $child = StockChild::whereIn('stock_id',$id_array)->get();
                 foreach($child as $key => $value)
                 {

                    $so_child = SoChild::where('serial_id',$value->id)->first();
                     if(isset($so_child)){
                              $flag = 1;
                         } 
                    }
                    if(!($flag))
                    {
                      DB::table($table_name)->whereIn('id', $id_array)->delete();
                      $res['status'] = 'Success';
                      $res['message'] = 'Deleted successfully';
                    } 
                    else {
                    $res['status'] = 'Error';
                    $res['message'] = 'Serial No Is Associat SomeWhere';
                    }
               }
               elseif($table_name == 'so')
               {
                 $data = So::whereIn('id',$id_array)->delete();
                 $data = SoChild::whereIn('so_id',$id_array)->delete();        
                 $data = Bsr::whereIn('so_id',$id_array)->delete();        

                 $res['status'] = 'Success';
                 $res['message'] = 'Deleted successfully';

               }
               elseif($table_name == 'gst')
               {
                    $flag = 0;
                    $gstck = DB::table($table_name)->whereIn('id', $id_array)->get();
                    foreach ($gstck as $key => $value) {
                         $check = DB::table('hsn')->where('gst_id',$value->id)->first();
                         $checks = DB::table('products')->where('gst_id',$value->id)->first();
                         if(isset($check)){
                              $flag = 1;
                         } elseif(isset($checks)){
                              $flag = 1;
                         }
                    }
                    if(!($flag))
                    {
                      DB::table($table_name)->whereIn('id', $id_array)->delete();
                      $res['status'] = 'Success';
                      $res['message'] = 'Deleted successfully';
                    } else {
                    $res['status'] = 'Error';
                    $res['message'] = 'GST Is Associat With HSN Or Product';
                    }

               }
               elseif($table_name == 'group')
               {
                    $flag = 0;
                    $gstck = DB::table($table_name)->whereIn('id', $id_array)->get();
                    foreach ($gstck as $key => $value) {
                         $check = DB::table('products')->where('group_name',$value->id)->first();
                         if(isset($check)){
                              $flag = 1;
                         }
                    }
                    if(!($flag))
                    {
                      DB::table($table_name)->whereIn('id', $id_array)->delete();
                      $res['status'] = 'Success';
                      $res['message'] = 'Deleted successfully';
                    } else {
                    $res['status'] = 'Error';
                    $res['message'] = 'Group Is Associat With Product';
                    }

               }
               elseif($table_name == 'unit')
               {
                    $flag = 0;
                    $gstck = DB::table($table_name)->whereIn('id', $id_array)->get();
                    foreach ($gstck as $key => $value) {
                         $check = DB::table('products')->where('sale',$value->id)->first();
                         $checks = DB::table('products')->where('purchase',$value->id)->first();
                         $checkss = DB::table('products')->where('gst_unit',$value->id)->first();
                         if(isset($check)){
                              $flag = 1;
                         }
                         if(isset($checks)){
                              $flag = 1;
                         }
                         if(isset($checkss)){
                              $flag = 1;
                         }
                    }
                    if(!($flag))
                    {
                      DB::table($table_name)->whereIn('id', $id_array)->delete();
                      $res['status'] = 'Success';
                      $res['message'] = 'Deleted successfully';
                    } else {
                    $res['status'] = 'Error';
                    $res['message'] = 'Unit Is Associat With Product';
                    }

               }
               else{
                    DB::table($table_name)->whereIn('id', $id_array)->delete();
                       $res['status'] = 'Success';
                       $res['message'] = 'Deleted successfully';
               }

          } catch (\Exception $ex) {
               $res['status'] = 'Error';
               $res['message'] = $ex->getMessage();
          }

          return response()->json($res);

     }



     public function changeMultipleStatus(Request $request)
     {

          $table_name = $request->get('table_name');
          $param = $request->get('param');
          $id_array = explode(',', $request->get('id'));
          try {
               if ($param == 0) {
                    foreach ($id_array as $id) {
                         DB::table($table_name)->where('id', $id)
                         ->update([
                              $request->field => 0,
                         ]);
                    }

                    if($table_name == 'item'){
                         $fritems = FranchiseItem::where('item_id',$request->id)->delete();
                    }
               } elseif ($param == 1) {
                    foreach ($id_array as $id) {
                         DB::table($table_name)->where('id', $id)
                         ->update([
                              $request->field => 1,
                         ]);
                    }
               }

               if($table_name == 'settings') {
                    $all_setting = Settings::where('status', 1)->pluck('value','name')->toArray();
                    file_put_contents(base_path() .'/config/common.php',  '<?php return ' . var_export($all_setting, true) . ';');
               }

               $res['status'] = 'Success';
               $res['message'] = 'Status Change successfully';

          } catch (\Exception $ex) {
               $res['status'] = 'Error';
               $res['message'] = 'Something went wrong.';
          }

          return response()->json($res);

     }

}

