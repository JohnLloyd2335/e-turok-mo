<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Vaccine;
use App\Models\Immunization;
use App\Models\ImmunizationCategory;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboard()
    {
        // dd(in_array(auth()->user()->user_type_id,[1,2]));
        date_default_timezone_set('Asia/Manila');
        $immunization_categories = ImmunizationCategory::all();


        $immunization_rows = Immunization::count();
        $immunizations = Immunization::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(date_recorded) as month_name"))
            ->whereYear('date_recorded', date('Y'))
            ->orderBy('date_recorded', 'ASC')
            ->groupBy(DB::raw("Monthname(date_recorded)"))
            ->pluck('count', 'month_name');

        $infant_rows = Immunization::where('immunization_category_id', '1')->count();
        $school_aged_rows = Immunization::where('immunization_category_id', '2')->count();
        $pregnant_rows = Immunization::where('immunization_category_id', '3')->count();
        $adult_rows = Immunization::where('immunization_category_id', '4')->count();
        $senior_citizen_rows = Immunization::where('immunization_category_id', '5')->count();

       


        $labels = $immunizations->keys();
        $data = $immunizations->values();

        $lastYearImmunizations = Immunization::select(DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(date_recorded) as month_name"))
        ->whereYear('date_recorded', date('Y') - 1)
        ->orderBy('date_recorded', 'ASC')
        ->groupBy(DB::raw("Monthname(date_recorded)"))
        ->pluck('count', 'month_name');

        $lastYearlabels = $lastYearImmunizations->keys();
        $lastYeardata = $lastYearImmunizations->values();



        $user_rows = User::where('user_type_id', '>', '1')->count();
        $vaccine_rows = Vaccine::count();
        $archive_rows = Archive::count();
       
        

        return view('dashboard.index', compact('user_rows', 'vaccine_rows', 'immunization_rows', 'archive_rows', 'labels', 'data', 'infant_rows', 'school_aged_rows', 'pregnant_rows', 'adult_rows', 'senior_citizen_rows','immunization_categories','lastYearlabels','lastYeardata'));
    }
}
