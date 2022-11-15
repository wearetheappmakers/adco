<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Discount;
use DataTables;


class DiscountController extends Controller
{
    public function __construct(Discount $s)
    {
        $this->view = 'discount';
        $this->route = 'discount';
        $this->viewName = 'Discount';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Discount::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'discount'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('discount.index');
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
        $discount = new Discount();
        $discount->name = $request->name;
        $discount->value = $request->value;
        $discount->save();

        if($discount)
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
        $data['data'] = Discount::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = Discount::where('id',$id)->first();
        $data->name = $request->name;
        $data->value = $request->value;
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
