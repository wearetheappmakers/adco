<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use DataTables;
use Auth;


class CustomerController extends Controller
{

    public function __construct(Customer $s)
    {
        $this->view = 'customer';
        $this->route = 'customer';
        $this->viewName = 'Customer';

    }


    public function index(Request $request)
    {
        if ($request->ajax())
        {

            if(Auth::user()->role == 1){
                $query = Customer::with('users')->orderBy('id','DESC')->latest();
            } elseif(Auth::user()->role == 2){
                $query = Customer::with('users')->where('branch_id',Auth::user()->id)->orderBy('id','DESC')->latest();
            }
             elseif(Auth::user()->role == 3){
                $query = Customer::with('users')->where('branch_id',Auth::user()->branch_id)->orderBy('id','DESC')->latest();
            }

            return Datatables::of($query)
            
            ->addColumn('action', function ($row) { 
             {        
                $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'customer'])->render();                           
            }
            return $btn;
        })

            ->rawColumns(['action'])
            ->make(true);
        }
        return view('customer.index');
    }

    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        return view('general.add_form')->with($data);
    }

    public function store(Request $request)
    {
        $stock = new Customer();
        if(Auth::user()->role == 1){
            $stock->branch_id = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $stock->branch_id = Auth::user()->id;
        }
        elseif (Auth::user()->role == 3){
            $stock->branch_id = Auth::user()->branch_id;
        }
        $stock->name = ucfirst($request->name);
        $stock->number = $request->number;
        $stock->email = $request->email;
        $stock->address = $request->address;
        $stock->save();
        if($stock)
        {
            return response()->json(['status'=>'success']);
        }else{
            return response()->json(['status'=>'error']);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ' . $this->viewName;
        $data['data'] = Customer::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('id','!=',1)->where('role',2)->where('status',1)->get();
        return view('general.edit_form')->with($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_method'],$data['_token']);

        if(Auth::user()->role == 1){
            $data['branch_id'] = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $data['branch_id'] = Auth::user()->id;
        } elseif (Auth::user()->role == 3){
            $data['branch_id'] = Auth::user()->branch_id;
        }
        $data['name'] = ucfirst($request->name);
        $data = Customer::where('id', $id)->update($data);
        if($data)
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
