<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Immunization;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use App\Http\Controllers\ArchiveController;

class RestoreImmunizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'province' => 'required',
            'municipality' => 'required',
            'barangay' => 'required',
            'contact_no' => 'required|min:11|max:11',
            'father_full_name' => 'required',
            'mother_full_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vaccine_received' => 'required',
            'doses' => 'required',
            'doses_received' => 'required',
            'first_dose_schedule' => 'required',
            'second_dose_schedule' => 'required',
            'third_dose_schedule' => 'required',
            'first_dose_vaccinated_at' => 'required',
            'second_dose_vaccinated_at' => 'required',
            'third_dose_vaccinated_at' => 'required',
            'remarks' => 'required',
            'date_recorded' => 'required',
        ]);


        Immunization::create([
            'immunization_id' => $request->immunization_id,
            'immunization_category_id' => $request->immunization_category_id,
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
            'place_of_birth' => $request->place_of_birth,
            'age' => $request->age,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'province' => $request->province,
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

        $archive = Archive::find($id);
        $archive->delete();

        $category = Immunization::getCategory($request->immunization_category_id);
        UserActivityLog::create([
            'user_id' => auth()->user()->id,
            'activity' => 'Restore Immunization',
            'description' => 'Restore Immunization '.$request->first_name.' '.$request->middle_name.' '.$request->last_name.'('.$category.')',
            'date_time'=> now(),
        ]);

        return redirect()->route('archives.index')->with('success','Restore Successfully');

    }
}
