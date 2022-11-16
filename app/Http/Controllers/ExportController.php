<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Exports\ImmunizationExport;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Auth\Events\Validated;

class ExportController extends Controller
{
    public function export(Request $request){

        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'immunization_category' => 'required',
            'password' => 'required',
            
        ]);



        if(!Hash::check($request->password,auth()->user()->password)){
            return redirect()->route('dashboard')->with('error','Password is not matched');
        }

        $immunizations = Immunization::exportImmunization($request->start_date,$request->end_date,$request->immunization_category);

        
        date_default_timezone_set('Asia/Manila');
        $datenow = date('Y-m-d H:i:s');
        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Download Report',
            'description' => $request->start_date." To ".$request->end_date,
            'date_time'=> now(),
        ]);
        return Excel::download(new ImmunizationExport($immunizations),'immunization_list_'.$datenow.'.xlsx');
    }
}
