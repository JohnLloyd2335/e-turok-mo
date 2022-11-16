<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $archives = Archive::with('immunization_category')->get();
        return view('archive.index',compact('archives'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $archive = Archive::find($id);
        $archive->delete();
        $category = Immunization::getCategory($archive->immunization_category_id);
        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Delete Immunization',
            'description' => 'Delete Immunization '.$archive->first_name.' '.$archive->middle_name.' '.$archive->last_name.'('.$category.')',
            'date_time'=> now(),
        ]);

        return redirect()->route('archives.index')->with('success', 'Permanently Deleted Successfully');
    }

    public function multiAction(Request $request){

        if(!in_array($request->actions,['Restore','Delete'])){
            return redirect()->back()->with('error','Oops There was an error please try again');
        }

        $request->validate([
            'actions' => 'required',
            'immunizationIds' => 'required',
        ]);

        if(strval($request->actions) === "Restore"){

            for($i=0; $i < count($request->immunizationIds); $i++){

                $archive = Archive::find($request->immunizationIds[$i]);
                
                Immunization::create([
                    'immunization_category_id' => $archive->immunization_category_id,
                    'first_name' => $archive->first_name,
                    'middle_name' => $archive->middle_name,
                    'last_name' => $archive->last_name,
                    'date_of_birth' => $archive->date_of_birth,
                    'gender' => $archive->gender,
                    'place_of_birth' => $archive->place_of_birth,
                    'age' => $archive->age,
                    'province' => $archive->province,
                    'municipality' => $archive->municipality,
                    'barangay' => $archive->barangay,
                    'contact_no' => $archive->contact_no,
                    'father_full_name' => $archive->father_full_name,
                    'mother_full_name' => $archive->mother_full_name,
                    'height' => $archive->height,
                    'weight' => $archive->weight,
                    'vaccine_received' => $archive->vaccine_received,
                    'doses' => $archive->doses,
                    'doses_received' => $archive->doses_received,
                    'first_dose_schedule' => $archive->first_dose_schedule,
                    'second_dose_schedule' => $archive->second_dose_schedule,
                    'third_dose_schedule' => $archive->third_dose_schedule,
                    'first_dose_vaccinated_at' => $archive->first_dose_vaccinated_at,
                    'second_dose_vaccinated_at' => $archive->second_dose_vaccinated_at,
                    'third_dose_vaccinated_at' => $archive->third_dose_vaccinated_at,
                    'remarks' => $archive->remarks,
                    'date_recorded' => $archive->date_recorded,
                ]);

                $category = Immunization::getCategory($archive->immunization_category_id);
                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Restore Immunization',
                    'description' => 'Restore Immunization '.$archive->first_name.' '.$archive->middle_name.' '.$archive->last_name.'('.$category.')',
                    'date_time'=> now(),
                ]);

                $archive->delete();

                
           }

           return redirect()->route('archives.index')->with('success','Restore Successfully');

        }
        elseif(strval($request->actions) === "Delete"){
            for($i=0; $i < count($request->immunizationIds); $i++){

                $archive = Archive::find($request->immunizationIds[$i]);
                $category = Immunization::getCategory($archive->immunization_category_id);
                UserActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'activity' => 'Delete Immunization',
                    'description' => 'Delete Immunization '.$archive->first_name.' '.$archive->middle_name.' '.$archive->last_name.'('.$category.')',
                    'date_time'=> now(),
                ]);

                $archive->delete();

            }  
            return redirect()->route('archives.index')->with('success', 'Permanently Deleted Successfully');

        }
    }

    
}
