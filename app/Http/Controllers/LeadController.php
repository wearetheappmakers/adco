<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use DataTables;
use Auth;
use App\Imports\GstImport;
use App\Exports\GstExport;
use Maatwebsite\Excel\Facades\Excel;


class LeadController extends Controller
{

    public function __construct(Lead $s)
    {
        $this->view = 'lead';
        $this->route = 'lead';
        $this->viewName = 'Lead';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Lead::with('branch','employees')->latest();
            if(Auth::user()->role == 2)
            {
                $query = Lead::with('branch','employees')->where('branch_id',Auth::user()->id)->latest();
            }
            if(Auth::user()->role == 3)
            {
                $query = Lead::with('branch','employees')->where('employee_id',Auth::user()->id)->latest();
            }
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'lead'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('lead.index');
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
        $lead = new Lead();
        if(Auth::user()->role == 1)
        {
            $lead->branch_id = $request->branch_id;
            $lead->employee_id = $request->employee_id;
        }
        elseif (Auth::user()->role == 2) {
            $lead->branch_id = Auth::user()->id;
            $lead->employee_id = $request->employee_id;
        }
        elseif (Auth::user()->role == 3) {
            $lead->branch_id = Auth::user()->branch_id;
            $lead->employee_id = Auth::user()->id;
        }
        $lead->name = $request->name;
        if(isset($request['image']))
        {
            $imageName = time().'-'. $request->image->getClientOriginalName();
            $request->image->move(public_path('lead/'),$imageName);
            $lead->image = $imageName;
        }
        $lead->number = $request->number;
        $lead->email = $request->email;
        // dd($lead);
        $lead->save();

        if($lead)
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
        $data['data'] = Lead::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
         $lead = Lead::where('id',$id)->first();
        if(Auth::user()->role == 1)
        {
            $lead->branch_id = $request->branch_id;
            $lead->employee_id = $request->employee_id;
        }
        elseif (Auth::user()->role == 2) {
            $lead->branch_id = Auth::user()->id;
            $lead->employee_id = $request->employee_id;
        }
        elseif (Auth::user()->role == 3) {
            $lead->branch_id = Auth::user()->branch_id;
            $lead->employee_id = Auth::user()->id;
        }
        if(isset($request['image']))
        {
            $imageName = time().'-'. $request->image->getClientOriginalName();
            $request->image->move(public_path('lead/'),$imageName);
            $lead->image = $imageName;
        }
        $lead->name = $request->name;
        $lead->number = $request->number;
        $lead->email = $request->email;

        $lead->save();
        if($lead)
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
