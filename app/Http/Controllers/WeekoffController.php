<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weekoff;
use DataTables;
use App\Holiday;
use Carbon\Carbon;


class WeekoffController extends Controller
{

    public function __construct(Weekoff $s)
    {
        $this->view = 'weekoff';
        $this->route = 'weekoff';
        $this->viewName = 'Weekoff';

    }
    
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Weekoff::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
               {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'weekoff'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('weekoff.index');
    }

    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.add_form')->with($data);
    }

    
    public function store(Request $request)
    {
        $data = $request->all();
        $data['name'] = ucfirst($request->name);
        $param = Weekoff::create($data);
        if($param)
        {
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }

        
        // $weekday = $request->month_year;
        // // $firstday = date('l', $weekday);
        // $start_day = $weekday.'-01-01';
        // $last_day = $weekday.'-12-31';
        // $date1_ts = strtotime($start_day);
        // $date2_ts = strtotime($last_day);
        // $diff = $date2_ts - $date1_ts;
        // $count = round($diff / 86400) + 1;
        // $day = date('l',strtotime($start_day));
        // // dd($day);
       
        // for ($i = 0; $i <= $count; $i++)
        // {          
        //     if($i == $start_day)
        //     {               
        //         $days = $start_day;
        //         $day = date('l',strtotime($start_day));
        //     }
        //     else
        //     {
        //         $days = date('Y-m-d',strtotime($start_day. ' +1 days'));
        //         $day = date('l',strtotime($days));
     
        //     } 
        //     if($request->sun){
        //         if($day == 'Sunday')
        //         {
        //            $holiday = new Holiday();
        //            $holiday->name = 'Holiday';
        //            $holiday->date = $day;                  
        //            $holiday->save();                 
        //         }                
        //     }
        // }    
        

        
        if($data)
        {
            return response()->json(['status' => 'success']);
        }else
        {
            return response()->json(['status' => 'error']);
        }
    }
    

    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Weekoff::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $data = Weekoff::where('id',$id)->first();
        $data->name = ucfirst($request->name);
        $data->mon = $request->mon;
        $data->tue = $request->tue;
        $data->wed = $request->wed;
        $data->thu = $request->thu;
        $data->fri = $request->fri;
        $data->sat = $request->sat;
        $data->sun = $request->sun;
        if($request->mon===null){
            $data->mon_type = 0;
        }else{
            $data->mon_type = $request->mon_type;
        }

        if($request->tue===null){
            $data->tue_type = 0;
        }else{
            $data->tue_type = $request->tue_type;
        }

        if($request->wed===null){
            $data->wed_type = 0;
        }else{
            $data->wed_type = $request->wed_type;
        }

        if($request->thu===null){
            $data->thu_type = 0;
        }else{
            $data->thu_type = $request->thu_type;
        }

        if($request->fri===null){
            $data->fri_type = 0;
        }else{
            $data->fri_type = $request->fri_type;
        }

        if($request->sat===null){
            $data->sat_type = 0;
        }else{
            $data->sat_type = $request->sat_type;
        }

        if($request->sun===null){
            $data->sun_type = 0;
        }else{
            $data->sun_type = $request->sun_type;
        }
        $data->save();
        if($data)
        {
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'error']);
        }
    }

    
    public function destroy($id)
    {
        //
    }

}
