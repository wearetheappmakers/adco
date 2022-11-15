<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Auth;

class UserController extends Controller
{
    public function __construct(User $s)
    {
        $this->view = 'user';
        $this->route = 'user';
        $this->viewName = 'User';

    }

    public function index(Request $request)
    {
        if ($request->ajax())
        {
            if(Auth::user()->role == 1){
            $query = User::latest();
        } elseif(Auth::user()->role == 2){
            $query = User::where('branch_id',Auth::user()->id)->get();
        }
            return Datatables::of($query)
            ->addColumn('action', function ($row) {  

                if($row->id==1)
                {
                    $btn = 'Cannot Change';
                }else{        
                    $btn = view('layouts.actionbtnpermission')->with(['id'=>$row->id,'route'=>'user'])->render();           
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

            ->addColumn('role', function ($row) {

                if($row->role==1)
                {
                    $schk = 'Admin';
                }
                elseif($row->role==2)
                { 
                    $schk = 'Branch';
                }
                elseif($row->role==3)
                { 
                    $schk = 'Employee';
                }               

                return $schk;
            })

            ->rawColumns(['action','singlecheckbox','role'])
            ->make(true);
        }
        return view('user.index');
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
        if(Auth::user()->role == 1){
            $user->role = $request->role;
            $user->branch_id = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $user->role = 3;
            $user->branch_id = Auth::user()->id;
        }
        $user->name = ucfirst($request->name);
        $user->number = $request->number;
        $user->email = $request->email;
        $user->password= Hash::make($request->get('password'));
        $user->showpasssword = $request->password;
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
        if(Auth::user()->role == 1){
            $data['role'] = $request->role;
            $data['branch_id'] = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $data['role'] = 3;
            $data['branch_id'] = Auth::user()->id;
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
