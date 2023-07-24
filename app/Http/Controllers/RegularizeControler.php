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


class RegularizeControler extends Controller
{

    public function __construct(Regularize $s)
    {
        $this->view = 'regularize';
        $this->route = 'regularize';
        $this->viewName = 'Regularizetion';

    }


    public function index(Request $request)
    {
        {
            if ($request->ajax())
            {
                if(Auth::user()->role == 1){
                $query = Regularize::with('branchs','users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = Regularize::with('branchs','users')->where('branch_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 3){            
                $query = Regularize::with('branchs','users')->where('employee_id',Auth::user()->id)->latest();
            }

                if($request->branch_id)
                {
                    $query = $query->with('branchs','users')->where('branch_id',$request->branch_id)->latest();

                }
                return Datatables::of($query)

                ->addColumn('action', function ($row) { 
                 { 

                    if($row->status === "Pending"){       
                        $btn = '<a style="background: white;" href="'.route('regularize.edit', $row->id).'" title="Edit" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: green;" class="la la-edit"></i></a> &nbsp;

                        <a style="background: white;" href="'.route('regularize.show', $row->id).'" title="Show Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>'; 
                    } else {
                       $btn = '<a style="background: white;" href="'.route('regularize.show', $row->id).'" title="Show Regularization" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>'; 
                   }          
               }
               return $btn;
           })

                ->addColumn('dropdown', function ($row) {
                if($row->status !== "Pending" || Auth::user()->role == 3)
                {
                    $btn = '<select class="form-control" disabled><option value="Pending"';
                }
                else
                {
                    $btn = '<select class="form-control" onchange="status(this,'.$row->id.')"><option value="todo"';
                }
                $selected = '';
                        if($row->status === "Pending" )
                        {
                            $selected = 'selected';
                        }
                        $btn .= $selected.'>Pending</option><option value="Approved" ';

                        $selected = '';
                        if($row->status === "Approved" )
                        {
                            $selected = 'selected';
                        }
                        $btn .= $selected.'>Approved</option><option value="Reject" ';

                        $selected = '';
                        if($row->status === "Reject")
                        {
                            $selected = 'selected';
                        }
                        $btn .= $selected.'>Reject</option></select>';

                        return $btn;

            })


                ->addColumn('date', function ($row) {
                    $ac = date('d-m-Y',strtotime($row->date));
                    return $ac;
                })


                ->rawColumns(['dropdown','action'])
                ->make(true);
            }
            $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
            $data['category'] = Category::get();
            return view('regularize.index')->with($data);
        }
    }

    public function create(Request $request)
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['user'] = User::get();
        $data['data'] = Attendance::where('id', $request->id)->first();

        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {
        $attendance = Attendance::where('id',$request->attendance_id)->first();

        $data = new Regularize();  
        $data->branch_id = $attendance->branch_id;
        $data->employee_id = $attendance->employee_id;
        $data->attendance = $attendance->attendance;
        $data->date = $attendance->date;
        $data->time = $attendance->time;
        $data->attendance_id = $request->attendance_id;
        $data->type = $request->type;
        $data->reason = $request->reason;
        $data->status = "Pending";
        // dd($data);
        $data->save();

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
        $data['data'] = Regularize::where('id', $id)->first();
        $data['user'] = User::get();        
        return view('regularize.show')->with($data);
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Regularize::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['user'] = User::get();
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = Regularize::where('id',$id)->first();
        $data->type = $request->type;
        $data->reason = $request->reason;
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

    public function regularizestatus(Request $request)
    {
        $param['status'] = $request->status;
        if($param['status'] === "Approved"){
            $attend = Regularize::where('id',$request->id)->value('attendance_id');

            $data = Attendance::where('id',$attend)->first();
            // dd($data);
            $data->attendance = "Present";
            $data->save();

        }
        $change_status = Regularize::where('id',$request->id)->update($param);

        if($change_status)
        {
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

}
