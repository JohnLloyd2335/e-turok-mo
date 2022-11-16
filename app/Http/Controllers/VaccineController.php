<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Vaccine;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Models\VaccineCategory;
use App\Http\Requests\StoreVaccineRequest;
use App\Http\Requests\UpdateVaccineRequest;


class VaccineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vaccine_categories = VaccineCategory::all();
        $vaccines = Vaccine::with('vaccine_category')->orderBy('date_created','DESC')->get();
        
        return view('vaccine.index', compact('vaccine_categories','vaccines'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVaccineRequest $request)
    {
      
        $request->validated();

        if($request->doses == "1"){
            $second_dose_years_interval = "";
            $second_dose_months_interval = "";
            $second_dose_days_interval = "";
            $third_dose_years_interval = "";
            $third_dose_months_interval = "";
            $third_dose_days_interval = "";
        }
        elseif($request->doses == "2"){
            $second_dose_years_interval = $request->second_dose_years_interval;
            $second_dose_months_interval = $request->second_dose_months_interval;
            $second_dose_days_interval = $request->second_dose_days_interval;
            $third_dose_years_interval = "";
            $third_dose_months_interval = "";
            $third_dose_days_interval = "";
        }
        else{
            $second_dose_years_interval = $request->second_dose_years_interval;
            $second_dose_months_interval = $request->second_dose_months_interval;
            $second_dose_days_interval = $request->second_dose_days_interval;
            $third_dose_years_interval = $request->third_dose_years_interval;
            $third_dose_months_interval = $request->third_dose_months_interval;
            $third_dose_days_interval = $request->third_dose_days_interval;
        }
         

        Vaccine::create([
            'vaccine_category_id' => $request->vaccine_category_id,
            'vaccine_name' => $request->vaccine_name,
            'doses' => $request->doses,
            'status' => 'Available',
            'second_dose_years_interval' => $second_dose_years_interval,
            'second_dose_months_interval' => $second_dose_months_interval,
            'second_dose_days_interval' => $second_dose_days_interval,
            'third_dose_years_interval' => $third_dose_years_interval,
            'third_dose_months_interval' => $third_dose_months_interval,
            'third_dose_days_interval' => $third_dose_days_interval,
            'description' => $request->description,
            'date_created' => date('Y-m-d'),
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Add Vaccine',
            'description' => "Add ".$request->vaccine_name,
            'date_time'=> now(),
        ]);
        
        return redirect()->route('vaccines.index')->with('success','Vaccine Added Successfuly!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccine $vaccine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccine $vaccine)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVaccineRequest $request, Vaccine $vaccine)
    {
       
        $request->validated();
        

        $vaccine->update([
            'vaccine_category_id' => $request->vaccine_category_id,
            'vaccine_name' => $request->vaccine_name,
            'doses' => $request->doses,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update Vaccine',
            'description' => 'Update Vaccine ID: '.$vaccine->id,
            'date_time'=> now(),
        ]);

        return redirect()->route('vaccines.index')->with('success','Vaccine Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccine  $vaccine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccine $vaccine)
    {
        $vaccine->delete();

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Delete Vaccine',
            'description' => 'Delete Vaccine('.$vaccine->vaccine_name.')',
            'date_time'=> now(),
        ]);

        return redirect()->route('vaccines.index')->with('success','Vaccine Deleted Successfully');
    }

    public function multiAction(Request $request){
        
       
        if(!in_array($request->actions,['Delete','Set Not Available','Set Available'])){
            return redirect()->back()->with('error','Oops There was an error please try again');
        }

        $request->validate([
            'actions' => 'required',
            'vaccineIds' => 'required',
        ]);

        
        if(strval($request->actions) === "Delete"){
            for($i = 0; $i < count($request->vaccineIds); $i++){

                $vaccine = Vaccine::find($request->vaccineIds[$i]);
 
                UserActivityLog::create([
                     'user_id' => auth()->user()->id,
                     'activity' => 'Delete Vaccine',
                     'description' => 'Delete Vaccine('.$vaccine->vaccine_name.')',
                     'date_time'=> now(),
                 ]);
 
            }

            Vaccine::whereIn('id',$request->vaccineIds)->delete();
            
            return redirect()->route('vaccines.index')->with('success','Vaccines Deleted Successfully');
        }
        elseif(strval($request->actions) === "Set Not Available"){
            for($i = 0; $i < count($request->vaccineIds); $i++){

                $vaccine = Vaccine::find($request->vaccineIds[$i]);
                $vaccine->update([
                    'status' => 'Not Available',
                ]);
 
                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Update Vaccine',
                    'description' => 'Update Vaccine ID: '.$vaccine->id,
                    'date_time'=> now(),
                ]);
 
            }

          
            
            return redirect()->route('vaccines.index')->with('success','Vaccines Edited Successfully');
        }
        elseif(strval($request->actions) === "Set Available"){
            for($i = 0; $i < count($request->vaccineIds); $i++){

                $vaccine = Vaccine::find($request->vaccineIds[$i]);
                $vaccine->update([
                    'status' => 'Available',
                ]);
 
                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Update Vaccine',
                    'description' => 'Update Vaccine ID: '.$vaccine->id,
                    'date_time'=> now(),
                ]);
 
            }

          
            
            return redirect()->route('vaccines.index')->with('success','Vaccines Edited Successfully');
        }
        else{
            return redirect()->back()->with('error','Oops There was an error please try again');
        }
    }

    

    
}
