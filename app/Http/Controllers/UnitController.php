<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unit;
use DataTables;


class UnitController extends Controller
{

    public function __construct(Unit $s)
    {
        $this->view = 'unit';
        $this->route = 'unit';
        $this->viewName = 'Unit';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Unit::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
               {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'unit'])->render();           
            }
            return $btn;
        })


            ->rawColumns(['action'])
            ->make(true);
        }
        return view('unit.index');
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
        $unit = new Unit();
        $unit->name = ucfirst($request->name);
        $unit->save();

        if($unit)
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
        $data['data'] = Unit::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = Unit::where('id',$id)->first();
        $data->name = ucfirst($request->name);
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
