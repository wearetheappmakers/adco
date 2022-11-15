<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function deleteMultiple(Request $request)
    {

        $table_name = $request->get('table_name');
        $id_array = explode(',', $request->get('id'));

        try {

            DB::table($table_name)->whereIn('id', $id_array)->delete();

            $res['status'] = 'Success';
            $res['message'] = 'Deleted successfully';

        } catch (\Exception $ex) {
            $res['status'] = 'Error';
            $res['message'] = $ex->getMessage();
        }
        return response()->json($res); //return response()->json(['status' => 'success', 'message' => 'Deleted']);
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
