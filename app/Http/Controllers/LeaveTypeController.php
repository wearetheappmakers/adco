<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LeaveType;
use DataTables;
use App\Imports\GstImport;
use App\Exports\GstExport;
use Maatwebsite\Excel\Facades\Excel;


class LeaveTypeController extends Controller
{

    public function __construct(LeaveType $s)
    {
        $this->view = 'leavetype';
        $this->route = 'leavetype';
        $this->viewName = 'LeaveType';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = LeaveType::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'leavetype'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('leavetype.index');
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
        $leavetype = new LeaveType();
        $leavetype->name = $request->name;
        $leavetype->save();

        if($leavetype)
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
        $data['data'] = LeaveType::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = LeaveType::where('id',$id)->first();
        $data->name = $request->name;
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
