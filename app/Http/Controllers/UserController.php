<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Attendance;
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
            $query = User::where('role',3)->latest();
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

             ->addColumn('branch_id', function ($row) {
                $btn = $row->branch->name;
                return $btn;
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

            ->rawColumns(['action','singlecheckbox','role','branch_id'])
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
            $user->role = 3;
            $user->branch_id = $request->branch_id;
        } elseif (Auth::user()->role == 2){
            $user->role = 3;
            $user->branch_id = Auth::user()->id;
        }
        $user->name = ucfirst($request->name);
        $user->number = $request->number;
        $user->leave_policy_id = $request->leave_policy_id;

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
        $user->weekoff_id = $request->weekoff_id;
        $user->punch_in = $request->punch_in;
        $user->punch_out = $request->punch_out;
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
            $data['role'] = 3;
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
        $data['name'] = ucfirst($request->name);
        $data['leave_policy_id'] = $request->leave_policy_id;
        
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

    public function punchIn()
    {
        $check = Attendance::where([['employee_id',Auth::user()->id],['date',date('Y-m-d')]])->exists();
        
        $present = 'Present';
        $leave_check = Attendance::where([['employee_id',Auth::user()->id],['date',date('Y-m-d')]])->whereIn('attendance',['First Half,Second Half,Full day'])->exists();
        if(!$leave_check)
        {
            $proxy_time = strtotime("+15 minutes", strtotime(Auth::user()->punch_in_time));
            $proxy_time = date('Hi',$proxy_time);
            if(date('Hi') > date('Hi',strtotime(Auth::user()->punch_in_time)))
            {
                $present = 'Missed';
            }
        }
        if($check)
        {
            $present = 'Present';
        }

        $attend = new Attendance();
        $attend['branch_id'] = Auth::user()->branch_id;
        $attend['employee_id'] = Auth::user()->id;
        $attend['date'] = date('Y-m-d');
        $attend['punch_in'] = date('H:i');
        $attend['attendance'] = $present;
        $attend->save();

        $notification = array(
            'message' => 'User Punched In successfully',
            'alert-type' => 'success'
        );

        
        // if($check){
        //     $add =  [
        //                 'branch_id' => Auth::user()->branch_id,
        //                 'employee_id' => Auth::user()->id,
        //                 'date' => date('Y-m-d'),
        //                 'punch_in' => date('H:i'),
        //             ];
        //     $adddata = Attendance::where('employee_id',Auth::user()->id)->update($add);
        // }

        return back()->with($notification);
        
    }

    public function punchOut()
    {
        $check = Attendance::where([['employee_id',Auth::user()->id],['date',date('Y-m-d')],['punch_in','!=',null],['punch_out',null]])->latest()->first();

        if(isset($check))
        {
            $check['date'] = date('Y-m-d');
            $check['punch_out'] = date('H:i');
            $check->save();

            $notification = array(
                'message' => 'User Punched Out successfully',
                'alert-type' => 'success'
            );

            return back()->with($notification);
        }
    }
}
