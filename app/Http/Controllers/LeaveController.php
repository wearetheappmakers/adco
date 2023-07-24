<?php

namespace App\Http\Controllers;
use Auth;
use App\Leave;
use App\User;
use App\Attendance;
use App\LeaveChild;
use App\LeavePolicy;
use App\LeaveType;
use App\LeavePolicyChild;
use DataTables;
use Illuminate\Http\Request;

class LeaveController extends Controller
{
     public function __construct(Leave $s)
    {
        $this->view = 'leave';
        $this->route = 'leave';
        $this->viewName = 'Leave';

    }
    public function index(Request $request)
    {
         if ($request->ajax())
        {
            $query = Leave::with('branch','employees')->latest();
            if(Auth::user()->role == 2)
            {
            	$query = Leave::with('branch','employees')->where('branch_id',Auth::user()->id)->latest();
            }
            elseif (Auth::user()->role == 3) {
            	$query = Leave::with('branch','employees')->where('employee_id',Auth::user()->id)->latest();
            }
            return Datatables::of($query)
            
             ->addColumn('action', function ($row) {         
                $btn = '<a style="background: white;" href="'.route('leave.show', $row->id).'" title="view" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i style="color: black;" class="flaticon-eye"></i></a>';
                return $btn;
            })

             ->addColumn('status', function ($row) {
             	   
                   

                if($row->status == 2 || $row->status == 3 || $row->employee_id == Auth::user()->id)
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
                $btn .= $selected.'>Approved</option><option value="3" ';
                $selected = '';
                if($row->status == 3)
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Reject</option></select>';


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


            ->rawColumns(['action','status','branch_id','employee_id'])
            ->make(true);
        }
        return view('leave.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.add_form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     public function leaveemployeereport(Request $request)
    {
        $id = $request->id;

        $branch_id = $request->branch_id;

        $type = LeaveType::get();
        $html = '<table class="table table-striped- table-bordered table-hover table-checkable datatable"><thead><tr><th>Type</th><th>Alloated(this year)</th><th>Alloated(this month)</th><th>Approved (this month)</th><th>Remaining (this month)</th></tr></thead><tbody>';
        // dd($branch_id);
        if(Auth::user()->role == 1 || Auth::user()->role == 2)
        {
            foreach($type as $tp)
            {

                $policy_id = User::where('id',$branch_id)->value('leave_policy_id');
                $policy = LeavePolicy::where('id',$policy_id)->first();
                $policy_child = LeavePolicyChild::where('policy_id',$policy_id)->where('leave_type_id',$tp->id)->first();

                if(isset($policy_child))
                {
                    $total_alloated_leave = $policy_child->day;
                    $approved = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.branch_id',$branch_id)->where('le.status',2)->where('le.leave_types',$tp->id)->select('leave_child.*')->whereMonth('date',date('m'))->whereYear('date',date('Y'))->get();
                    $count = 0;
                    foreach($approved as $ap)
                    {
                        if($ap->approved_duration == 'Full day')
                        {
                            $count += 1;
                        }
                        else
                        {
                            $count += 0.5;
                        }
                    }
                    $remaining = $total_alloated_leave - $count;
                    if($policy_child->is_extendable == 1)
                    {
                        $approved = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.branch_id',$branch_id)->where('le.status',2)->where('le.leave_types',$tp->id)->select('leave_child.*')->whereYear('date',date('Y-m-d'))->get();

                        $leave_count = 0;
                        foreach($approved as $aps)
                        {
                            if($aps->approved_duration == 'Full day')
                            {
                                $leave_count += 1;
                            }
                            else
                            {
                                $leave_count += 0.5;
                            }
                        }

                        $count = $leave_count . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';

                        $days = $total_alloated_leave * 12;
                        $total_alloated_leave = $days . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';
                        $remaining = $days - $leave_count . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';;
                    }
                    $html .= '<tr><td>'.$tp->name.'</td><td>'.($policy_child->day * 12).'</td><td>'.$total_alloated_leave.'</td><td>'.$count.'</td><td>'.$remaining.'</td></tr>';
                }
                

            }
        }

        if($id)
        {
            $html = '<table class="table table-striped- table-bordered table-hover table-checkable datatable"><thead><tr><th>Type</th><th>Alloated(this year)</th><th>Alloated(this month)</th><th>Approved (this month)</th><th>Remaining (this month)</th></tr></thead><tbody>';
            foreach($type as $tp)
            {
                $policy_id = User::where('id',$id)->value('leave_policy_id');
                $policy = LeavePolicy::where('id',$policy_id)->first();
                $policy_child = LeavePolicyChild::where('policy_id',$policy_id)->where('leave_type_id',$tp->id)->first();
                if(isset($policy_child))
                {
                    $approved = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.employee_id',$id)->where('le.status',2)->where('le.leave_types',$tp->id)->select('leave_child.*')->whereMonth('date',date('m'))->whereYear('date',date('Y'))->get();
                    $count = 0;
                    foreach($approved as $ap)
                    {
                        if($ap->approved_duration == 'Full day')
                        {
                            $count += 1;
                        }
                        else
                        {
                            $count += 0.5;
                        }
                    }
                    $total_alloated_leave = $policy_child->day;
                    $remaining = $total_alloated_leave - $count;
                    if($policy_child->is_extendable == 1)
                    {
                        $approved = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.employee_id',$id)->where('le.status',2)->where('le.leave_types',$tp->id)->select('leave_child.*')->whereYear('date',date('Y-m-d'))->get();

                        $leave_count = 0;
                        foreach($approved as $aps)
                        {
                            if($aps->approved_duration == 'Full day')
                            {
                                $leave_count += 1;
                            }
                            else
                            {
                                $leave_count += 0.5;
                            }
                        }

                        $count = $leave_count . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';

                        $total_alloated_leave = ($policy_child->day * 12) . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';
                        $remaining = ($policy_child->day * 12) - $leave_count . ' - <span class="kt-badge kt-badge--unified-success kt-badge--sm kt-badge--bold"> E </span>';;
                    }

                    $html .= '<tr><td>'.$tp->name.'</td><td>'.($policy_child->day * 12).'</td><td>'.$total_alloated_leave.'</td><td>'.$count.'</td><td>'.$remaining.'</td></tr>';
                }
                
            }
        }

        

        $html .= "</tbody></table>";

        echo $html;
    }
    public function store(Request $request)
    {
       
        if(Auth::user()->role == 1)
        {
            $branch_id = $request->branch_id;
            $employee_id = $request->employee_id;
        }            
        elseif (Auth::user()->role == 2) {
            $branch_id = Auth::user()->id;
            $employee_id = $request->employee_id;
        }
        elseif (Auth::user()->role == 3) {
            $branch_id = Auth::user()->branch_id;
            $employee_id = Auth::user()->id;
        }

         $policy_id = User::where('id',$employee_id)->value('leave_policy_id');

        $policy = LeavePolicy::where('id',$policy_id)->first();
      // dd($policy);
        $policy_child = LeavePolicyChild::where('policy_id',$policy_id)->where('leave_type_id',$request->leave_types)->first();
        // dd($policy_id);
     
        $leavechild = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.employee_id',$employee_id)->where('le.status',2)->where('le.leave_types',$request->leave_types)->select('leave_child.*')->get();

        $total_leave = 0;
        $day_array = [];
        foreach ($request->date as $key => $value) 
        {
            $total_yearly_leave = LeaveChild::leftjoin('leave as le','le.id','leave_child.leave_id')->where('le.employee_id',$employee_id)->where('le.status',2)->where('le.leave_types',$request->leave_types)->select('leave_child.*')->whereYear('date',$value)->count();
            array_push($day_array, $total_yearly_leave);
        

            if($value !== '')
            {

                if($request->duration[$key] == 1)
                {
                    $total_leave += 1;
                }
                elseif($request->duration[$key] == 2 || $request->duration[$key] == 3)
                {
                    $total_leave += 0.5;
                }
            }
        }
        $existing_leave = 0;
        foreach($leavechild as $lc)
        {

            if($lc->approved_duration == 'Full day')
            {
                $existing_leave += 1;
            }
            elseif($lc->approved_duration == 'First Half' || $lc->approved_duration == 'Second Half')
            {
                $existing_leave += 0.5;
            }
        }

        $total_leave += $existing_leave;
       

        if($policy_child['is_extendable'] == 1)
        {
           
            $flag = 0;
            $flag_array = [];
            foreach($day_array as $da)
            {

                if($da > $policy_child['day']*12)
                {
                    $flag = 0;

                }
                else
                {
                    $flag = 1;
                }
                array_push($flag_array, $flag);
            }

                // dd($flag_array);
            if(in_array(0, $flag_array))
            {
                return response()->json(['status' => 'limit_exceed']);
            }
            else
            {
                $leave = new Leave();
                // dd($leave);
                $leave->remark = $request->remark;
                if(Auth::user()->role == 1)
                {
                    $leave->branch_id = $request->branch_id;
                    $leave->employee_id = $request->employee_id;
                }            
                elseif (Auth::user()->role == 2) {
                    $leave->branch_id = Auth::user()->id;
                    $leave->employee_id = $request->employee_id;
                }
                elseif (Auth::user()->role == 3) {
                    $leave->branch_id = Auth::user()->branch_id;
                    $leave->employee_id = Auth::user()->id;
                }
                // $leave->branch_id = $request->branch_id;
                // $leave->employee_id = $request->employee_id;
                $leave->leave_types = $request->leave_types;
                $leave->status = 1;
                $leave->save();

                if($request->date)
                {
                    foreach ($request->date as $key => $value) {
                        $child = new LeaveChild();
                        $child->leave_id = $leave->id;
                        $child->date = $value;
                        $child->duration = $request->duration[$key];
                        $child->save();
                    }
                }

                if($leave)
                {
                    return response()->json(['status' => 'success']);
                }else
                {
                    return response()->json(['status' => 'error']);
                }
            }
        }
        elseif($total_leave <= $policy_child['day'])
        {

            $leave = new Leave();
       
            $leave->remark = $request->remark;
            // dd($leave);
            if(Auth::user()->role == 1)
                {
                    $leave->branch_id = $request->branch_id;
                    $leave->employee_id = $request->employee_id;
                }            
                elseif (Auth::user()->role == 2) {
                    $leave->branch_id = Auth::user()->id;
                    $leave->employee_id = $request->employee_id;
                }
                elseif (Auth::user()->role == 3) {
                    $leave->branch_id = Auth::user()->branch_id;
                    $leave->employee_id = Auth::user()->id;
                }
            // $leave->branch_id = $request->branch_id;
            // $leave->employee_id = $request->employee_id;
            $leave->leave_types = $request->leave_types;
            $leave->status = 1;
            $leave->save();

            if($request->date)
            {
                foreach ($request->date as $key => $value) {
                    $child = new LeaveChild();
                    $child->leave_id = $leave->id;
                    $child->date = $value;
                    $child->duration = $request->duration[$key];
                    $child->save();
                }
            }
            if($leave)
            {
                return response()->json(['status' => 'success']);
            }else
            {
                return response()->json(['status' => 'error']);
            }
        }
         else
        {
            return response()->json(['status' => 'limit_exceed']);
        }
        // $leave->remark = $request->remark;
        // $leave->leave_types = $request->leave_types;
        // $leave->save();

        // if($request->date)
        // {
        //     foreach ($request->date as $key => $value) {
        //         $child = new LeaveChild();
        //         $child->leave_id = $leave->id;
        //         $child->date = $value;
        //         $child->duration = $request->duration[$key];
        //         $child->save();
        //     }
        // }

       

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $data['data'] = Leave::where('id', $id)->first();
        $data['leavechild'] = LeaveChild::where('leave_id',$id)->get();

        return view('leave.show')->with($data);
    }

    public function status(Request $request)
    {
        $param['status'] = $request->status;
        $change_status = Leave::where('id',$request->id)->update($param);
        if($change_status)
        {
            return response()->json(['status' => 'success']);
        }
        else
        {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Leave::where('id', $id)->first();
        $data['leavechild'] = LeaveChild::where('leave_id',$id)->get();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!empty($request->approved_duration))
        {
            $update = Leave::where('id',$id)->first();
            $update->status = 2;
            $update->save();

            foreach($request->approved_duration as $key => $value)
            {
                $child = LeaveChild::where('id',$request->child_id[$key])->first();
                $child->approved_duration = $value;
                $child->save();

                $attend = new Attendance();
                $attend->employee_id = $update->employee_id;
                $attend->branch_id = $update->branch_id;
                $attend->date = $child->date;
                $attend->attendance = $value;
                $attend->save();
            }

        }

       
            return response()->json(['status' => 'success']);
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getemployee(Request $request)
    {

        $data = User::where('branch_id',$request->branch_id)->where('role',3)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }

        echo $html;



    
    }
}
