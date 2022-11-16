<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\ImmunizationCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Immunization extends Model
{
    use HasFactory;

    public function immunization_category(){
        return $this->belongsTo(ImmunizationCategory::class);
    }

    public static function calculateInfantAge($date_of_birth){
        date_default_timezone_set('Asia/Manila');
        $months = Carbon::parse($date_of_birth)->diff(Carbon::now())->format('%m months old');
        return $months;
    }

    public static function calculateAge($date_of_birth){
        date_default_timezone_set('Asia/Manila');
        $years = Carbon::parse($date_of_birth)->diff(Carbon::now())->format('%y years old');
        return $years;
    }

    public static function exportImmunization($start_date,$end_date,$category){

        
        switch($category){
            case "1" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->where('immunization_category_id','1')->get(); break;
            case "2" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->where('immunization_category_id','2')->get(); break;
            case "3" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->where('immunization_category_id','3')->get(); break;
            case "4" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->where('immunization_category_id','4')->get(); break;
            case "5" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->where('immunization_category_id','5')->get(); break;
            case "all" : $immunizations = Immunization::whereBetween('date_recorded',[$start_date,$end_date])->get(); break;
            default : return redirect()->route('dashboard')->with('error','Ooops, There was an error Please try again');
            
        }
        return $immunizations;
    }

    public static function yearsMonthsToDays($years,$months,$days){

        $years = intval($years) * 365;
        $years = floor($years);

        $months =  intval($months) * 32;
        $months = floor($months);
        return $years + $months +  intval($days);
    }

    public static function getCategory($category_id){

        switch($category_id){
            case "1" : $category = "Infant"; break;
            case "2" : $category = "School Aged Children"; break;
            case "3" : $category = "Pregnant"; break;
            case "4" : $category = "Adult"; break;
            case "5" : $category = "Senior Citizen"; break;
            default : $category = "";
            
        }
        return $category;
    }
    
    

    protected $fillable = ['immunization_category_id','first_name','middle_name','last_name','date_of_birth','gender','place_of_birth','age','barangay','municipality','province','contact_no','father_full_name','mother_full_name','height','weight','vaccine_received','doses','doses_received','first_dose_schedule','first_dose_vaccinated_at','second_dose_schedule','second_dose_vaccinated_at','third_dose_schedule','third_dose_vaccinated_at','remarks','date_recorded']; 
}
