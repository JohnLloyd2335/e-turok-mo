<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;

class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_types = UserType::where('id','>=' ,'2')->get();
        $non_admin_users = User::where('user_type_id','>=' ,'2')->with('user_type')->orderBy('created_at','DESC')->get();
        return view('manage_user',compact('non_admin_users','user_types'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:30'],
            'middle_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'civil_status' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type_id' => ['required'],
            'barangay_name' => ['required'],
            'municipality_name' => ['required'],
            'province_name' => ['required'],
            
            // 'profile_img' => ['image'],
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validator($request->all())->validate();

        User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'age' => User::calculateAge($request->date_of_birth),
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_type_id' => $request->user_type_id,
            'barangay' => $request->barangay_name,
            'municipality' => $request->municipality_name,
            'province' => $request->province_name,
            'status' => 'Active',
            'date_recorded' => date('Y-m-d')
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Add User',
            'description' => 'Add User: '.$request->first_name." ".$request->middle_name." ".$request->last_name,
            'date_time'=> now(),
        ]);

        return redirect()->route('manage_users')->with('success','User Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $user = User::find($id);

        $request->validate([
            'first_name' => ['required', 'string', 'max:30'],
            'middle_name' => ['required', 'string', 'max:30'],
            'last_name' => ['required', 'string', 'max:30'],
            'date_of_birth' => ['required'],
            'civil_status' => ['required'],
            'gender' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($id,'id')],
            'user_type_id' => ['required'],
            'status' => ['required'],
            
        ]);

        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'civil_status' => $request->civil_status,
            'gender' => $request->gender,
            'email' =>  $request->email,
            'user_type_id' => $request->user_type_id,
            'status' => $request->status,
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update User',
            'description' => 'Update User ID: '.$id,
            'date_time'=> now(),
        ]);

        return redirect()->route('manage_users')->with('success','User Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user = User::find($id);
        $user->delete();

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Delete User',
            'description' => 'Delete User '.$user->first_name.' '.$user->middle_name.' '.$user->last_name,
            'date_time'=> now(),
        ]);

        return redirect()->route('manage_users')->with('success','User Deleted Successfully');
    }


    protected function guard()
    {
        return Auth::guard();
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    public function multiAction(Request $request){
        if(!in_array($request->actions,['Delete','Set Active','Set Inactive'])){
            return redirect()->back()->with('error','Oops There was an error please try again');
        }

        $request->validate([
            'actions' => 'required',
            'userIds' => 'required',
        ]);

        if(strval($request->actions) === "Delete"){
           
            for($i = 0; $i < count($request->userIds); $i++){

                $user = User::find($request->userIds[$i]);

                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Delete User',
                    'description' => 'Delete User '.$user->first_name.' '.$user->middle_name.' '.$user->last_name,
                    'date_time'=> now(),
                ]);

                $user->delete();

                return redirect()->route('manage_users')->with('success','Users Deleted Successfully');
            }

        }
        else if(strval($request->actions) === "Set Active"){
            for($i = 0; $i < count($request->userIds); $i++){

                $user = User::find($request->userIds[$i]);

                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Update User',
                    'description' => 'Update User ID: '.$user->id,
                    'date_time'=> now(),
                ]);

                $user->update([
                    'status' => 'Active',
                ]);

                return redirect()->route('manage_users')->with('success','Users Edited Successfully');
            }
        }
        else if(strval($request->actions) === "Set Inactive"){
            for($i = 0; $i < count($request->userIds); $i++){

                $user = User::find($request->userIds[$i]);

                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Update User',
                    'description' => 'Update User ID: '.$user->id,
                    'date_time'=> now(),
                ]);

                $user->update([
                    'status' => 'Inactive',
                ]);

                return redirect()->route('manage_users')->with('success','Users Edited Successfully');
            }
        }
        else{
            return redirect()->back()->with('error','Oops There was an error please try again');
        }
    }
}
