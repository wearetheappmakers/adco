<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\User;
use DataTables;
use File;
use Auth;

class TaskController extends Controller
{
    public function __construct(Task $s)
    {
        $this->view = 'task';
        $this->route = 'task';
        $this->viewName = 'Task';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
                $query = Task::latest();
            } elseif(Auth::user()->role == 2){
                $query = Task::where('assigned_to_branch',Auth::user()->id)->latest();
            } elseif(Auth::user()->role == 3){
                $query = Task::where('assigned_to_employee',Auth::user()->id)->orWhere('assigned_by',Auth::user()->id)->latest();
            }

            if($request->assigned_to_branch)
            {
                $query = $query->where('assigned_to_branch',$request->assigned_to_branch)->latest();
            }
            if($request->assigned_to_employee)
            {
                $query = $query->where('assigned_to_employee',$request->assigned_to_employee)->latest();
            }
            if($request->assigned_by)
            {
                $query = $query->where('assigned_by',$request->assigned_by)->latest();
            }

            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
                {        
                    $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'task'])->render();         
                }
                return $btn;
            })


            ->addColumn('dropdown', function ($row) {
                // if($row->status == 2)
                // {
                    // $btn = '<select class="form-control" disabled><option value="1"';
                // }
                // else
                // {
                    $btn = '<select class="form-control" onchange="status(this,'.$row->id.')"><option value="todo"';
                // }
                $selected = '';
                if($row->status === "todo" )
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>To Do</option><option value="doing" ';

                $selected = '';
                if($row->status === "doing")
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Doing</option><option value="check" ';

                $selected = '';
                if($row->status === "check")
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Check</option><option value="done" ';

                $selected = '';
                if($row->status === "done")
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>Done</option><option value="onhold" ';


                $selected = '';
                if($row->status === "onhold")
                {
                    $selected = 'selected';
                }
                $btn .= $selected.'>On Hold</option></select>';

                return $btn;

            })

            ->addColumn('start_date', function ($row) {
                if($row->start_date){
                $ac = date('d-m-Y',strtotime($row->start_date));
                } else{
                    $ac = '-';
                }
                return $ac;
            })

            ->addColumn('due_date', function ($row) {
                if($row->due_date){
                $ac = date('d-m-Y',strtotime($row->due_date));
                } else{
                    $ac = '-';
                }
                return $ac;
            })

            ->addColumn('assignedby', function ($row) {
                if($row->assigned_to_branch){
                $assignedby = User::where('id',$row->assigned_by)->value('name');
                $ac = $assignedby;
                } else{
                    $ac = '-';
                }
                return $ac;
            })

            ->addColumn('location', function ($row) {
                if($row->assigned_to_branch){
                $location = User::where('id',$row->assigned_to_branch)->value('name');
                $ac = $location;
                } else{
                    $ac = '-';
                }
                return $ac;
            })

            ->addColumn('employee', function ($row) {
                if($row->assigned_to_employee){
                $employee = User::where('id',$row->assigned_to_employee)->value('name');
                $ac = $employee;
                } else{
                    $ac = '-';
                }
                return $ac;
            })

            ->rawColumns(['action','dropdown','location','employee','assignedby'])
            ->make(true);
        }
        $data['location'] = User::where('role',2)->where('status',1)->get();
        if(Auth::user()->role == 2){
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->id)->get();
        } else {
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->branch_id)->get();
        }
        if(Auth::user()->role == 1){
            $data['assignedby'] = User::where('status',1)->get();
        } elseif(Auth::user()->role == 2) {
            $data['assignedby'] = User::where('status',1)->where('branch_id',Auth::user()->id)->get();
        } elseif(Auth::user()->role == 3) {
            $data['assignedby'] = User::where('status',1)->where('branch_id',Auth::user()->branch_id)->get();
        }
        return view('task.index')->with($data);
    }

    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('status',1)->where('role',2)->get();
        if(Auth::user()->role == 2){
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->id)->get();
        } else {
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->branch_id)->get();
        }
        return view('general.add_form')->with($data);
    }

    
    public function store(Request $request)
    {
        $data = new Task();
        $data->title = $request->title;
        $data->status = $request->status;
        $data->priority = $request->priority;
        $data->start_date = $request->start_date;
        $data->due_date = $request->due_date;
        // $data->time = $request->time;
        $data->assigned_by = Auth::user()->id;
        if(Auth::user()->role == 1){
            $data->assigned_to_branch = $request->assigned_to_branch;
        } elseif(Auth::user()->role == 2){
            $data->assigned_to_branch = Auth::user()->id;
        } elseif(Auth::user()->role == 3){
            $data->assigned_to_branch = Auth::user()->branch_id;
        }
        $data->assigned_to_employee = $request->assigned_to_employee;
        if(isset($request->attachment))
        {
            $imageName = time().'.'.$request->attachment->getClientOriginalExtension();        
            $request->attachment->move(public_path('task_attachment/'),$imageName);
            $data['attachment'] = $imageName;
        }
        $data->description = $request->description;
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
        //
    }


    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Task::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('status',1)->where('role',2)->get();
        if(Auth::user()->role == 2){
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->id)->get();
        } else {
            $data['employee'] = User::where('status',1)->where('branch_id',Auth::user()->branch_id)->get();
        }
        return view('general.edit_form')->with($data);
    }


    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_method'],$data['_token']);

        if (isset($request->attachment)) {
            $old_image = Task::where('id', $id)->value('attachment');
            if (isset($old_image)) {
                File::delete(public_path('task_attachment/' . $old_image));
            }
            $imageName = time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('task_attachment/'), $imageName);
            $data['attachment'] = $imageName;
        }
        // dd($request->description);
        
        $data = Task::where('id', $id)->update($data);
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

    public function getemployee(Request $request)
    {
        $data = User::where('role',3)->where('status',1)->where('branch_id',$request->assigned_to_branch)->get();
        $html = "<option value=''>Select</option>";
        foreach ($data as $key => $value) {
            $html .= "<option value=".$value->id.">".$value->name."</option>";
        }
        return response()->json(['data'=>$html]);
    }


    public function status(Request $request)
    {

        $param['status'] = $request->status;
        $change_status = Task::where('id',$request->id)->update($param);
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
