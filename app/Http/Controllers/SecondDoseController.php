<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immunization;

class SecondDoseController extends Controller
{
    /* infant */
    public function infantSecondDoseIndex(){
       
            $second_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','<','2'],
                ['immunization_category_id','=','1'],
            ])->orderBy('created_at','DESC')->get();
       
        

        
        
        return view('infant_second_dose', compact('second_doses'));
    }

    public function infantSetSchedule(Request $request, $id){
        $request->validate([
            'second_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->second_dose_schedule = strtotime($request->second_dose_schedule);
        $request->second_dose_schedule = date('Y-m-d H:i',$request->second_dose_schedule);
        $immunizations->update([
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('infant_second_dose')->with('success','Schedule Successfully Set');
    }

    public function editInfantImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'second_dose_date_time' => 'required',
            'second_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'second_dose_schedule' => $request->second_dose_date_time,
            'second_dose_vaccinated_at' => $request->second_dose_location,
        ]);

        return redirect()->route('infant_second_dose')->with('success','Immunization Successfully Edited!');
    }
    /* infant */

    /* school aged */
    public function SchoolAgedSecondDoseIndex(){
    
        
            $second_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','<','2'],
                ['immunization_category_id','=','2'],
            ])->orderBy('created_at','DESC')->get();
       

        return view('school_aged_second_dose', compact('second_doses'));
    }

    public function SchoolAgedSetSchedule(Request $request, $id){
        $request->validate([
            'second_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->second_dose_schedule = strtotime($request->second_dose_schedule);
        $request->second_dose_schedule = date('Y-m-d H:i',$request->second_dose_schedule);
        $immunizations->update([
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('school_aged_second_dose')->with('success','Schedule Successfully Set');
    }

    public function editSchoolAgedImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'second_dose_date_time' => 'required',
            'second_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'second_dose_schedule' => $request->second_dose_date_time,
            'second_dose_vaccinated_at' => $request->second_dose_location,
        ]);

        return redirect()->route('school_aged_second_dose')->with('success','Immunization Successfully Edited!');
    }
    /* school age */

    /* pregnant */
    public function pregnantSecondDoseIndex(){
        
        
            $second_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','<','2'],
                ['immunization_category_id','=','3'],
            ])->orderBy('created_at','DESC')->get();
        

        return view('pregnant_second_dose', compact('second_doses'));
    }

    public function pregnantSetSchedule(Request $request, $id){
        $request->validate([
            'second_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->second_dose_schedule = strtotime($request->second_dose_schedule);
        $request->second_dose_schedule = date('Y-m-d H:i',$request->second_dose_schedule);
        $immunizations->update([
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->location,
        ]);
        return redirect()->route('pregnant_second_dose')->with('success','Schedule Successfully Set');
    }

    public function editPregnantImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'second_dose_date_time' => 'required',
            'second_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'second_dose_schedule' => $request->second_dose_date_time,
            'second_dose_vaccinated_at' => $request->second_dose_location,
        ]);

        return redirect()->route('pregnant_second_dose')->with('success','Immunization Successfully Edited!');
    }
    /* pregnant */

    /* adult */
    public function adultSecondDoseIndex(){
        
        
            $second_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','<','2'],
                ['immunization_category_id','=','4'],
            ])->orderBy('created_at','DESC')->get();
        

        return view('adult_second_dose', compact('second_doses'));
    }

    public function adultSetSchedule(Request $request, $id){
        $request->validate([
            'second_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->second_dose_schedule = strtotime($request->second_dose_schedule);
        $request->second_dose_schedule = date('Y-m-d H:i',$request->second_dose_schedule);
        $immunizations->update([
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('adult_second_dose')->with('success','Schedule Successfully Set');
    }

    public function editAdultImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'second_dose_date_time' => 'required',
            'second_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'second_dose_schedule' => $request->second_dose_date_time,
            'second_dose_vaccinated_at' => $request->second_dose_location,
        ]);

        return redirect()->route('adult_second_dose')->with('success','Immunization Successfully Edited!');
    }
    /* adult */

    /* senior */
    public function seniorSecondDoseIndex(){
        
        
            $second_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','<','2'],
                ['immunization_category_id','=','5'],
            ])->orderBy('created_at','DESC')->get();
        
        

        return view('senior_second_dose', compact('second_doses'));
    }

    public function seniorSetSchedule(Request $request, $id){
        $request->validate([
            'second_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->second_dose_schedule = strtotime($request->second_dose_schedule);
        $request->second_dose_schedule = date('Y-m-d H:i',$request->second_dose_schedule);
        $immunizations->update([
            'second_dose_schedule' => $request->second_dose_schedule,
            'second_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('senior_second_dose')->with('success','Schedule Successfully Set');
    }

    public function editSeniorImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'second_dose_date_time' => 'required',
            'second_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'second_dose_schedule' => $request->second_dose_date_time,
            'second_dose_vaccinated_at' => $request->second_dose_location,
        ]);

        return redirect()->route('senior_second_dose')->with('success','Immunization Successfully Edited!');
    }
    /* senior */
}
