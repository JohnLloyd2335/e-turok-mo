<?php

namespace App\Http\Controllers;

use App\Models\UserActivityLog;
use Illuminate\Http\Request;

class UserActivityLogController extends Controller
{
    public function index(){
        $user_activity_logs = UserActivityLog::with('user')->orderBy('date_time','DESC')->get();
       

        return view('user_activity_log.index',compact('user_activity_logs'));
    }
}
