<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Holiday;
use DataTables;


class HolidayController extends Controller
{

    public function __construct(Holiday $s)
    {
        $this->view = 'holiday';
        $this->route = 'holiday';
        $this->viewName = 'Holiday';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Holiday::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'holiday'])->render();           
            }
            return $btn;
        })

            ->addColumn('date', function ($row) {
                $ac = date('d-m-Y',strtotime($row->date));
                return $ac;
            })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('holiday.index');
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
        $holiday = new Holiday();
        $holiday->name = ucfirst($request->name);
        $holiday->date = $request->date;
        $holiday->save();

        if($holiday)
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
        $data['data'] = Holiday::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = Holiday::where('id',$id)->first();
        $data->name = ucfirst($request->name);
        $data->date = $request->date;
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
