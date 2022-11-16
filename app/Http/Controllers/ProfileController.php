<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Rules\MatchOldPassword;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function setProfilePicture(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $request->validate([
            'profile_img' => 'required',
        ]);
       
        if(request()->hasFile('profile_img')){

            if(!empty(auth()->user()->profile_img)){
                $oldavatar = public_path('storage/avatars/'.auth()->user()->profile_img);
                unlink($oldavatar);
            }

            $fileName =  auth()->user()->id."_".request()->file('profile_img')->getClientOriginalName();
            request()->file('profile_img')->storeAs('avatars', $fileName ,'public');      
        }
        
        $user->update(['profile_img'=>$fileName]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update Profile Picture',
            'description' => 'Update Profile Picture Filename: '.$fileName,
            'date_time'=> now(),
        ]);


        return redirect()->route('my_profile.index')->with('success','Profile Successfuly Set');
        
    }

    public function changeProfile(Request $request){
        $validated = $request->validate([
            'first_name' => ['required'],
            'middle_name' => ['required'],
            'last_name' => ['required'],
            'date_of_birth' => ['required'],
            'gender' => ['required'],
            'civil_status' => ['required'],
            'email' => ['required','email',Rule::unique('users')->ignore(auth()->user()->id)],
            
        ]);

        if(!$validated){
            return redirect()->route('my_profile.index')->with('error','There was an error');
        }
        $user = User::find(auth()->user()->id);
        $user->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'age' => User::calculateAge($request->date_of_birth),
            'gender' => $request->gender,
            'civil_status' => $request->civil_status,
            'email' => $request->email,
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update Account Details',
            'description' => 'Update Account Details ID: '.auth()->user()->id,
            'date_time'=> now(),
        ]);

        return redirect()->route('my_profile.index')->with('success','Profile Successfuly Updated');
    }

    public function changePassword(Request $request){
        $request->validate([
            'old_password' => ['required', new MatchOldPassword],
            'new_password' => ['required','min:8'],
            'confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Change Password',
            'description' => 'Change Password ID: '.auth()->user()->id,
            'date_time'=> now(),
        ]);

        return redirect()->route('my_profile.index')->with('success','Password Successfuly Updated');
    }
}
