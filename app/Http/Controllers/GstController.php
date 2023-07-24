<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GST;
use DataTables;
use App\Imports\GstImport;
use App\Exports\GstExport;
use Maatwebsite\Excel\Facades\Excel;


class GstController extends Controller
{

    public function __construct(GST $s)
    {
        $this->view = 'gst';
        $this->route = 'gst';
        $this->viewName = 'GST';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = GST::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'gst'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('gst.index');
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
        $gst = new GST();
        $gst->name = $request->name;
        $gst->save();

        if($gst)
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
        $data['data'] = GST::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = GST::where('id',$id)->first();
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
