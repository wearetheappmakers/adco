<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeavePolicy;
use App\LeavePolicyChild;
use DataTables;
use App\Imports\GstImport;
use App\Exports\GstExport;
use Maatwebsite\Excel\Facades\Excel;


class LeavePolicyController extends Controller
{

    public function __construct(LeavePolicy $s)
    {
        $this->view = 'leavepolicy';
        $this->route = 'leavepolicy';
        $this->viewName = 'Leave Policy';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = LeavePolicy::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'leavepolicy'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('leavepolicy.index');
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
        $leavepolicy = new LeavePolicy();
        $leavepolicy->name = $request->name;
        $leavepolicy->no_of_days = $request->no_of_days;
        $leavepolicy->save();

        if($request->type_id)
        {
             foreach ($request->type_id as $key => $value) 
             {
                if($value != '')
                {
                   $child = new LeavePolicyChild();
                   $child->policy_id = $leavepolicy->id;
                   $child->leave_type_id = $value;
                   $child->day = $request->day[$key] ?? 0;
                   $child->is_extendable = $request->is_extendable[$key] ?? 0;
                 
                   $child->save();
                }
               
            }
        }
       
        if($leavepolicy)
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
        $data['data'] = LeavePolicy::where('id', $id)->first();
        $data['child'] = LeavePolicyChild::where('policy_id',$id)->get();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $leavepolicy = LeavePolicy::where('id',$id)->first();
        $leavepolicy->name = $request->name;
        $leavepolicy->no_of_days = $request->no_of_days;
        $leavepolicy->save();

        if($request['child_id'])
        {
            foreach($request->child_id as $key=>$value)
            {
                $edit_leave_child['day'] = $request['edit_day'][$key] ?? 0;
                $edit_leave_child['is_extendable'] = $request['edit_is_extendable'][$key] ?? 0;
                $store = LeavePolicyChild::where('id',$value)->update($edit_leave_child);
            }
        }

        if($request->type_id)
        {
             foreach ($request->type_id as $key => $value) 
             {
                if($value != '')
                {
                   $child = new LeavePolicyChild();
                   $child->policy_id = $leavepolicy->id;
                   $child->leave_type_id = $value;
                   $child->day = $request->day[$key] ?? 0;
                   $child->is_extendable = $request->is_extendable[$key] ?? 0;
                 
                   $child->save();
                }
               
            }
        }
         if($leavepolicy)
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

    
}
