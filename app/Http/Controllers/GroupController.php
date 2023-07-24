<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Group;
use DataTables;
use App\Imports\GstImport;
use App\Exports\GstExport;
use Maatwebsite\Excel\Facades\Excel;


class GroupController extends Controller
{

    public function __construct(Group $s)
    {
        $this->view = 'group';
        $this->route = 'group';
        $this->viewName = 'Group';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Group::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'group'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('group.index');
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
        $group = new Group();
        $group->name = $request->name;
        $group->save();

        if($group)
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
        $data['data'] = Group::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = Group::where('id',$id)->first();
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

    public function gst_export() 
    {
        return Excel::download(new GstExport, 'gst.xlsx');
    }

    public function gst_import(Request $request) 
    {
            
        if($request->ajax() && $request->isMethod('post')){
            Excel::import(new GstImport, $request->file('gst_excel'));
            return response()->json(['status'=>'success']);
        } else {
            return view('home');
        }
    }
}
