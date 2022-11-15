<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DataTables;


class CategoryController extends Controller
{
    public function __construct(Category $s)
    {
        $this->view = 'category';
        $this->route = 'category';
        $this->viewName = 'Category';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $query = Category::latest();
            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'category'])->render();           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('category.index');
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
        $user = new Category();
        $user->name = ucfirst($request->name);
        $user->save();

        if($user)
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
        $data['data'] = Category::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        return view('general.edit_form')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $data = Category::where('id',$id)->first();
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
