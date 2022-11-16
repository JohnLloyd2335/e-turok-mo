<?php

namespace App\Http\Controllers;

use App\Models\Immunization;
use App\Models\ImmunizationCategory;
use App\Models\Vaccine;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    //
    public function index(){
      
        date_default_timezone_set('Asia/Manila');
        $immunizations = Immunization::with('immunization_category')->orderBy('date_recorded','ASC')->get();
        $vaccines = Vaccine::all();

        $immunizationsThisDay = Immunization::where('doses', '>' ,'1')
        ->where(function($query){
            $query->whereDate('second_dose_schedule',today())
            ->orWhereDate('third_dose_schedule',today());
        })->get();

        $immunizationsThisMonth = Immunization::where('doses', '>' ,'1')
        ->where(function($query){
            $query->whereMonth('second_dose_schedule',now()->month)
            ->orWhereMonth('third_dose_schedule',now()->month);
        })->get();

        $immunizationsThisYear = Immunization::where('doses', '>','1')
        ->where(function($query){
            $query->whereYear('second_dose_schedule',now()->year)
            ->orWhereYear('third_dose_schedule',now()->year);
        })->get();

        $immunization_categories = ImmunizationCategory::all();


        //SELECT * FROM `immunizations`WHERE (doses >= 2 AND doses_received=1) AND second_dose_schedule < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND second_dose_schedule != 'Not Applicable' AND third_dose_schedule != 'Not Applicable';
        $incompletes2ndDose = Immunization::where('doses','>=','2')->where('doses_received','1')->where('second_dose_schedule', '!=', 'Not Applicable')->where('third_dose_schedule', '!=', 'Not Applicable')->whereDate('second_dose_schedule' ,'<', now())->with('immunization_category')->get();

        //SELECT * FROM `immunizations`WHERE (doses = 3 AND doses_received=2) AND third_dose_schedule < DATE_ADD(CURDATE(), INTERVAL 1 DAY) AND third_dose_schedule != 'Not Applicable';
        $incompletes3rdDose = Immunization::where('doses','3')->where('doses_received','2')->where('third_dose_schedule', '!=', 'Not Applicable')->whereDate('third_dose_schedule' ,'<', now())->with('immunization_category')->get();
        
       

        return view('report.index',compact('immunizations','vaccines','immunizationsThisDay','immunizationsThisMonth','immunizationsThisYear','immunization_categories','incompletes2ndDose','incompletes3rdDose'));
    }
}
