<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hsn;
use App\GST;
use DataTables;
use App\Imports\HsnImport;
use App\Exports\HsnExport;
use Maatwebsite\Excel\Facades\Excel;

class HsnController extends Controller
{

    public function __construct(Hsn $s)
    {
        $this->view = 'hsn';
        $this->route = 'hsn';
        $this->viewName = 'HSN';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Hsn::with('gsts')->latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'hsn'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('hsn.index');
    }


    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['gst'] = GST::get();
        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {        
        if($request->name)
        {
            $hsn = Hsn::where('name',$request->name)->value('name');
            if($hsn)
            {
                return response()->json(['status' => 'duplicate_hsn']);
            }
        }
        $hsn = new Hsn();
        $hsn->gst_id = $request->gst_id;
        $hsn->name = $request->name;
        $hsn->name_of_print = $request->name_of_print;
        $hsn->fix_rate = $request->fix_rate;
        $hsn->rcp = $request->rcp;
        $hsn->fsp = $request->fsp;
        $hsn->rack_no = $request->rack_no;
        $hsn->mrp = $request->mrp;
        $hsn->save();

        if($hsn)
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
        $data['data'] = Hsn::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['gst'] = GST::get();
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        if($request->name)
        {
            $hsn = Hsn::where('name',$request->name)->where('id','!=',$id)->value('name');
            if($hsn)
            {
                return response()->json(['status' => 'duplicate_hsn']);
            }
        }
        $data = Hsn::where('id',$id)->first();
        $data->name = $request->name;
        $data->gst_id = $request->gst_id;
        $data->name_of_print = $request->name_of_print;
        $data->fix_rate = $request->fix_rate;
        $data->rcp = $request->rcp;
        $data->fsp = $request->fsp;
        $data->rack_no = $request->rack_no;
        $data->mrp = $request->mrp;
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

    public function hsn_export() 
    {
        return Excel::download(new HsnExport, 'hsn.xlsx');
    }

    public function hsn_import(Request $request) 
    {
            
        if($request->ajax() && $request->isMethod('post')){
            Excel::import(new HsnImport, $request->file('hsn_excel'));
            return response()->json(['status'=>'success']);
        } else {
            return view('home');
        }
    }
}
