<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Immunization;

class ThirdDoseController extends Controller
{
    /* infant */
    public function infantThirdDoseIndex(){

       
            $third_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','>=','2'],
                ['doses_received','<','3'],
                ['immunization_category_id','=','1'],
            ])->orderBy('created_at','DESC')->get();
       

        return view('infant_third_dose', compact('third_doses'));
    }

    public function infantSetSchedule(Request $request, $id){
        $request->validate([
            'third_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->third_dose_schedule = strtotime($request->third_dose_schedule);
        $request->third_dose_schedule = date('Y-m-d H:i',$request->third_dose_schedule);
        $immunizations->update([
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('infant_third_dose')->with('success','Schedule Successfully Set');
    }

    public function editInfantImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'third_dose_date_time' => 'required',
            'third_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'third_dose_schedule' => $request->third_dose_date_time,
            'third_dose_vaccinated_at' => $request->third_dose_location,
        ]);

        return redirect()->route('infant_third_dose')->with('success','Immunization Successfully Edited!');
    }
    /* infant */

    /* school aged */
    public function SchoolAgedThirdDoseIndex(){
    
        
            $third_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','>=','2'],
                ['doses_received','<','3'],
                ['immunization_category_id','=','2'],
            ])->orderBy('created_at','DESC')->get();
        

        return view('school_aged_third_dose', compact('third_doses'));
    }

    public function SchoolAgedSetSchedule(Request $request, $id){
        $request->validate([
            'third_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->third_dose_schedule = strtotime($request->third_dose_schedule);
        $request->third_dose_schedule = date('Y-m-d H:i',$request->third_dose_schedule);
        $immunizations->update([
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('school_aged_third_dose')->with('success','Schedule Successfully Set');
    }

    public function editSchoolAgedImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'third_dose_date_time' => 'required',
            'third_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'third_dose_schedule' => $request->third_dose_date_time,
            'third_dose_vaccinated_at' => $request->third_dose_location,
        ]);

        return redirect()->route('school_aged_third_dose')->with('success','Immunization Successfully Edited!');
    }
    /* school age */

    /* pregnant */
    public function pregnantThirdDoseIndex(){
        
        
            $third_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','>=','2'],
                ['doses_received','<','3'],
                ['immunization_category_id','=','3'],
            ])->orderBy('created_at','DESC')->get();
       

        return view('pregnant_third_dose', compact('third_doses'));
    }

    public function pregnantSetSchedule(Request $request, $id){
        $request->validate([
            'third_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->third_dose_schedule = strtotime($request->third_dose_schedule);
        $request->third_dose_schedule = date('Y-m-d H:i',$request->third_dose_schedule);
        $immunizations->update([
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('pregnant_third_dose')->with('success','Schedule Successfully Set');
    }

    public function editPregnantImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'third_dose_date_time' => 'required',
            'third_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'third_dose_schedule' => $request->third_dose_date_time,
            'third_dose_vaccinated_at' => $request->third_dose_location,
        ]);

        return redirect()->route('pregnant_third_dose')->with('success','Immunization Successfully Edited!');
    }
    /* pregnant */

    /* adult */
    public function adultThirdDoseIndex(){
        
        
            $third_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','>=','2'],
                ['doses_received','<','3'],
                ['immunization_category_id','=','4'],
            ])->orderBy('created_at','DESC')->get();
       
       

        return view('adult_third_dose', compact('third_doses'));
    }

    public function adultSetSchedule(Request $request, $id){
        $request->validate([
            'third_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->third_dose_schedule = strtotime($request->third_dose_schedule);
        $request->third_dose_schedule = date('Y-m-d H:i',$request->third_dose_schedule);
        $immunizations->update([
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('adult_third_dose')->with('success','Schedule Successfully Set');
    }

    public function editAdultImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'third_dose_date_time' => 'required',
            'third_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'third_dose_schedule' => $request->third_dose_date_time,
            'third_dose_vaccinated_at' => $request->third_dose_location,
        ]);

        return redirect()->route('adult_third_dose')->with('success','Immunization Successfully Edited!');
    }
    /* adult */

    /* senior */
    public function seniorThirdDoseIndex(){
        
       
            $third_doses = Immunization::where([
                ['doses','>','1'],
                ['doses_received','>=','2'],
                ['doses_received','<','3'],
                ['immunization_category_id','=','5'],
            ])->orderBy('created_at','DESC')->get();
        

        return view('senior_third_dose', compact('third_doses'));
    }

    public function seniorSetSchedule(Request $request, $id){
        $request->validate([
            'third_dose_schedule' => 'required',
            'location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $request->third_dose_schedule = strtotime($request->third_dose_schedule);
        $request->third_dose_schedule = date('Y-m-d H:i',$request->third_dose_schedule);
        $immunizations->update([
            'third_dose_schedule' => $request->third_dose_schedule,
            'third_dose_vaccinated_at' => $request->location,
        ]);

        return redirect()->route('senior_third_dose')->with('success','Schedule Successfully Set');
    }

    public function editSeniorImmunization(Request $request, $id){

        $request->validate([
            'contact_no' => 'required|digits:11',
            'doses_received' => 'required',
            'third_dose_date_time' => 'required',
            'third_dose_location' => 'required',
        ]);

        $immunizations = Immunization::find($id);
        $immunizations->update([
            'contact_no' => $request->contact_no,
            'doses_received' => $request->doses_received,
            'third_dose_schedule' => $request->third_dose_date_time,
            'third_dose_vaccinated_at' => $request->third_dose_location,
        ]);

        return redirect()->route('senior_third_dose')->with('success','Immunization Successfully Edited!');
    }
    /* senior */
}
