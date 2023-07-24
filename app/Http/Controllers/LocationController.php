<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class LocationController extends Controller
{
    public function __construct(User $s)
    {
        $this->view = 'location';
        $this->route = 'location';
        $this->viewName = 'Location';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
           
            $query = User::where('role',2)->latest();
       
            return Datatables::of($query)
            ->addColumn('action', function ($row) {  

                if($row->id==1)
                {
                    $btn = 'Cannot Change';
                }else{        
                    $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'location'])->render();           
                }
                return $btn;
            })


            ->addColumn('singlecheckbox', function ($row) {

                if($row->id==1)
                {
                    $schk = 'Cannot Change';
                }else{ 
                    $schk = view('layouts.singlecheckbox')->with(['id' => $row->id , 'status'=>$row->status])->render(); 
                }               

                return $schk;
            })

           
            ->rawColumns(['action','singlecheckbox','role'])
            ->make(true);
        }
        return view('location.index');
    }

    
    public function create()
    {
        $data['title'] = 'Add ' . $this->viewName;
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('role',2)->where('status',1)->get();
        return view('general.add_form')->with($data);
    }

    
    public function store(Request $request)
    {
        $user = new User();
        $user->role = 2;
        $user->name = ucfirst($request->name);
        $user->number = $request->number;
        if($request->email)
        {
            $check = User::where('email',$request->email)->first();
            if($check)
            {
                 return response()->json(['status' => 'duplicate']);
            }
            else
            {
                $user->email = $request->email;

            }
        }
        $user->password= Hash::make($request->get('password'));
        $user->showpasssword = $request->password;
        // $user->weekoff_id = $request->weekoff_id;
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
        $data['data'] = User::where('id', $id)->first();
        $data['module'] = $this->viewName;
        $data['resourcePath'] = $this->view;
        $data['branch'] = User::where('role',2)->where('status',1)->get();
        return view('general.edit_form')->with($data);
    }

    
    public function update(Request $request, $id)
    {
        $data = $request->all();
        unset($data['_method'],$data['_token']);
     
         $data['role'] = 2;
         if($request->email)
        {
            $check = User::where('email',$request->email)->where('id','!=',$id)->first();
            if($check)
            {
                 return response()->json(['status' => 'duplicate']);
            }
            else
            {
                $data['email'] = $request->email;

            }
        }
        if($request->password)
        {
            $data['showpasssword'] = $request->password;
            $data['password'] = bcrypt($request->password);
        }else{
            unset($data['password']);
        }
        $data['name'] = ucfirst($request->name);
        $data = User::where('id', $id)->update($data);
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
