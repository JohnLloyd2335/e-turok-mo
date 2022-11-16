<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Archive;
use App\Models\Vaccine;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Http\Requests\StoreImmunizationRequest;
use App\Http\Requests\UpdateImmunizationRequest;

class SchoolAgedChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $vaccines = Vaccine::where([
            ['vaccine_category_id', '2'],
            ['status', 'Available'],
            ])->get();

        $immunizations = Immunization::where('immunization_category_id', '2')->with('immunization_category')->orderBy('date_recorded', 'DESC')->get();
        
        return view('school_age_immunization.index', compact('vaccines', 'immunizations'));
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
    public function store(StoreImmunizationRequest $request)
    {
        $vaccines = Vaccine::where('vaccine_name', $request->vaccine_received)->get();
        $subset = $vaccines->map->only(['second_dose_years_interval','second_dose_months_interval','second_dose_days_interval','third_dose_years_interval','third_dose_months_interval','third_dose_days_interval']);
        
        $second_dose_years_interval = $subset[0]['second_dose_years_interval'];
        $second_dose_months_interval = $subset[0]['second_dose_months_interval'];
        $second_dose_days_interval = $subset[0]['second_dose_days_interval'];
        $third_dose_years_interval = $subset[0]['third_dose_years_interval'];
        $third_dose_months_interval = $subset[0]['third_dose_months_interval'];
        $third_dose_days_interval = $subset[0]['third_dose_days_interval'];
        
        
        

        
        
        if($vaccines->contains('doses', '1')) {
            date_default_timezone_set('Asia/Manila');
            $first_dose_schedule = date('Y-m-d H:i');
            $second_dose_schedule = "Not Applicable";
            $second_dose_vaccinated_at = "Not Applicable";
            $third_dose_schedule = "Not Applicable";
            $third_dose_vaccinated_at = "Not Applicable";
            $vaccine_dose = 1;
        }elseif ($vaccines->contains('doses', '2')) {

            $second_dose_shed_days = Immunization::yearsMonthsToDays($second_dose_years_interval,$second_dose_months_interval,$second_dose_days_interval);
            $second_dose_shed_days = strval($second_dose_shed_days);

           
            date_default_timezone_set('Asia/Manila');
            $first_dose_schedule = date('Y-m-d H:i');
            $second_dose_schedule =  Carbon::createFromFormat('Y-m-d H:i', $first_dose_schedule)->addDays($second_dose_shed_days);
            $second_dose_vaccinated_at = $request->first_dose_vaccinated_at;    
            $third_dose_schedule = "Not Applicable";
            $third_dose_vaccinated_at = "Not Applicable";
            $vaccine_dose = 2;
        }elseif ($vaccines->contains('doses', '3')) {
            $second_dose_shed_days = Immunization::yearsMonthsToDays($second_dose_years_interval,$second_dose_months_interval,$second_dose_days_interval);
            $second_dose_shed_days = strval($second_dose_shed_days);

            $third_dose_shed_days = Immunization::yearsMonthsToDays($third_dose_years_interval,$third_dose_months_interval,$third_dose_days_interval);
            $third_dose_shed_days = strval($third_dose_shed_days);
            
            date_default_timezone_set('Asia/Manila');
            $first_dose_schedule = date('Y-m-d H:i');
            $second_dose_schedule =  Carbon::createFromFormat('Y-m-d H:i', $first_dose_schedule)->addDays($second_dose_shed_days);
            $second_dose_vaccinated_at = $request->first_dose_vaccinated_at;
             
            $third_dose_schedule = Carbon::createFromFormat('Y-m-d H:i', $first_dose_schedule)->addDays($second_dose_shed_days + $third_dose_shed_days);
            $third_dose_vaccinated_at =  $request->first_dose_vaccinated_at;   
            $vaccine_dose = 3;
        }


    
        date_default_timezone_set('Asia/Manila');
        $age = Immunization::calculateAge($request->date_of_birth);      
        Immunization::create([
            'immunization_category_id' => $request->immunization_category_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'age' => $age,
            'barangay' => $request->barangay,
            'municipality' => "Pila",
            'province' => "Laguna",
            'contact_no' => $request->contact_no,
            'father_full_name' => $request->father_full_name,
            'mother_full_name' => $request->mother_full_name,
            'height' => $request->height,
            'weight' => $request->weight,
            'vaccine_received' => $request->vaccine_received,
            'doses' => $vaccine_dose,
            'doses_received' => $request->doses_received,
            'first_dose_schedule' => $first_dose_schedule,
            'first_dose_vaccinated_at' => $request->first_dose_vaccinated_at,
            'second_dose_schedule' => $second_dose_schedule,
            'second_dose_vaccinated_at' => $second_dose_vaccinated_at,
            'third_dose_schedule' => $third_dose_schedule,
            'third_dose_vaccinated_at' => $third_dose_vaccinated_at,
            'remarks' => $request->remarks,
            'date_recorded' => date('Y-m-d'),
        ]);
        
        $category = Immunization::getCategory($request->immunization_category_id);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Add Immunization',
            'description' => 'Add '.$request->first_name.' '.$request->middle_name.' '.$request->last_name.'('.$category.')',
            'date_time'=> now(),
        ]);

        return redirect()->route('school_aged_immunizations.index')->with('success', 'Immunization Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function show(Immunization $immunization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function edit(Immunization $immunization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateImmunizationRequest $request, $id)
    {
        
        date_default_timezone_set('Asia/Manila');
        $age = Immunization::calculateAge($request->date_of_birth);
        $immunization = new Immunization();

        $immunization = Immunization::find($id);
        
      
        if($immunization['doses'] == "1"){
            $request->second_dose_schedule = "Not Applicable";
            $request->second_dose_vaccinated_at = "Not Applicable";
            $request->third_dose_schedule = "Not Applicable";
            $request->third_dose_vaccinated_at = "Not Applicable";
        }
        elseif($immunization['doses'] == "2"){
            $request->third_dose_schedule = "Not Applicable";
            $request->third_dose_vaccinated_at = "Not Applicable";
        }
        else{
            $request->second_dose_schedule =  $request->second_dose_schedule ;
            $request->second_dose_vaccinated_at =  $request->second_dose_vaccinated_at;
            $request->third_dose_schedule =  $request->third_dose_schedule;
            $request->third_dose_vaccinated_at =  $request->third_dose_vaccinated_at;
        }

        $immunization->update([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'barangay' => $request->barangay,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'age' =>  $age,
            'contact_no' => $request->contact_no,
            'father_full_name' => $request->father_full_name,
            'mother_full_name' => $request->mother_full_name,
            'height' => $request->height,
            'weight' => $request->weight,
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->second_dose_vaccinated_at,
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->third_dose_vaccinated_at,
            'remarks' => $request->remarks,
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Update Immunization',
            'description' => 'Update Immunization ID: '.$id,
            'date_time'=> now(),
        ]);

        return redirect()->route('school_aged_immunizations.index')->with('success', 'Immunization Edited Successfuly!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Immunization  $immunization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        $request->validate([
            'immunization_id' => 'required',
            'immunization_category_id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'age' => 'required',
            'barangay' => 'required',
            'municipality' => 'required',
            'province' => 'required',
            'contact_no' => 'required|min:11|max:11',
            'father_full_name' => 'required',
            'mother_full_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vaccine_received' => 'required',
            'doses' => 'required',
            'doses_received' => 'required',
            'first_dose_schedule' => 'required',
            'first_dose_vaccinated_at' => 'required',
            'second_dose_schedule' => 'required',
            'second_dose_vaccinated_at' => 'required',
            'third_dose_schedule' => 'required',
            'third_dose_vaccinated_at' => 'required',
            'remarks' => 'required',
            'date_recorded' => 'required',
        ]);

        Archive::create([
            'immunization_id' => $request->immunization_id,
            'immunization_category_id' => $request->immunization_category_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'province' => $request->province,
            'municipality' => $request->municipality,
            'barangay' => $request->barangay,
            'contact_no' => $request->contact_no,
            'father_full_name' => $request->father_full_name,
            'mother_full_name' => $request->mother_full_name,
            'height' => $request->height,
            'weight' => $request->weight,
            'vaccine_received' => $request->vaccine_received,
            'doses' => $request->doses,
            'doses_received' => $request->doses_received,
            'first_dose_schedule' => $request->first_dose_schedule,
            'second_dose_schedule' => $request->second_dose_schedule,
            'third_dose_schedule' => $request->third_dose_schedule,
            'first_dose_vaccinated_at' => $request->first_dose_vaccinated_at,
            'second_dose_vaccinated_at' => $request->second_dose_vaccinated_at,
            'third_dose_vaccinated_at' => $request->third_dose_vaccinated_at,
            'remarks' => $request->remarks,
            'date_recorded' => $request->date_recorded,
        ]);

        $immunization = new Immunization();
        $immunization->find($id)->delete();
        $category = Immunization::getCategory($request->immunization_category_id);
        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Archive Immunization',
            'description' => 'Archive Immunization '.$request->first_name.' '.$request->middle_name.' '.$request->last_name.'('.$category.')',
            'date_time'=> now(),
        ]);

        return redirect()->route('school_aged_immunizations.index')->with('success', 'Immunization Successfully Moved to Archive');
    }

    public function administered(Request $request){
        $request->validate([
            'immunization_id' => 'required',
        ]);

        $immunization = Immunization::find($request->immunization_id);
        
        $immunization_current_dose = $immunization->doses_received;
        $immunization->update([
            'doses_received' => $immunization_current_dose + 1,
        ]);

        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Administered Immunization',
            'description' => 'Administered Immunization ID: '.$request->immunization_id,
            'date_time'=> now(),
        ]);

        return redirect()->route('school_aged_immunizations.index')->with('success','Doses Successfully Administered');
    }
    public function multiAction(Request $request){
        
       
        if(!in_array($request->actions,['Archive','Administer'])){
            return redirect()->back()->with('error','Oops There was an error please try again');
        }

        $request->validate([
            'actions' => 'required',
            'immunizationIds' => 'required',
        ]);

        
        if(strval($request->actions) === "Archive"){
            
           for($i=0; $i < count($request->immunizationIds); $i++){

                $immunization = Immunization::find($request->immunizationIds[$i]);
                
                Archive::create([
                    'immunization_id' => $request->immunizationIds[$i],
                    'immunization_category_id' => $immunization->immunization_category_id,
                    'first_name' => $immunization->first_name,
                    'middle_name' => $immunization->middle_name,
                    'last_name' => $immunization->last_name,
                    'date_of_birth' => $immunization->date_of_birth,
                    'gender' => $immunization->gender,
                    'place_of_birth' => $immunization->place_of_birth,
                    'age' => $immunization->age,
                    'province' => $immunization->province,
                    'municipality' => $immunization->municipality,
                    'barangay' => $immunization->barangay,
                    'contact_no' => $immunization->contact_no,
                    'father_full_name' => $immunization->father_full_name,
                    'mother_full_name' => $immunization->mother_full_name,
                    'height' => $immunization->height,
                    'weight' => $immunization->weight,
                    'vaccine_received' => $immunization->vaccine_received,
                    'doses' => $immunization->doses,
                    'doses_received' => $immunization->doses_received,
                    'first_dose_schedule' => $immunization->first_dose_schedule,
                    'second_dose_schedule' => $immunization->second_dose_schedule,
                    'third_dose_schedule' => $immunization->third_dose_schedule,
                    'first_dose_vaccinated_at' => $immunization->first_dose_vaccinated_at,
                    'second_dose_vaccinated_at' => $immunization->second_dose_vaccinated_at,
                    'third_dose_vaccinated_at' => $immunization->third_dose_vaccinated_at,
                    'remarks' => $immunization->remarks,
                    'date_recorded' => $immunization->date_recorded,
                ]);

                $category = Immunization::getCategory($immunization->immunization_category_id);
                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Archive Immunization',
                    'description' => 'Archive Immunization '.$immunization->first_name.' '.$immunization->middle_name.' '.$immunization->last_name.'('.$category.')',
                    'date_time'=> now(),
                ]);

                $immunization->delete();

                
           }

           return redirect()->route('school_aged_immunizations.index')->with('success', 'Immunizations Successfully Moved to Archive');
           
               
            
        }
        elseif(strval($request->actions) === "Administer"){
            for($i=0; $i < count($request->immunizationIds); $i++){

               
                
                $immunization = Immunization::find($request->immunizationIds[$i]);

                $addDose = ($immunization->doses === $immunization->doses_received) ? 0 : 1;
            
                
                $immunization->update([
                    'doses_received' => $immunization->doses_received + $addDose,
                ]);
            
                if($addDose == 1){
                    UserActivityLog::create([
                        'user_id' => auth()->user()->id,
                        'activity' => 'Administered Immunization',
                        'description' => 'Administered Immunization ID: '.$immunization->id,
                        'date_time'=> now(),
                    ]);
                }
                
                
 
            }

            return redirect()->route('school_aged_immunizations.index')->with('success','Doses Successfully Administered');
        }
        else{
            return redirect()->back()->with('error','Oops There was an error please try again');
        }
    }
}
