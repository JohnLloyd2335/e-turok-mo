<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    public $timestamps = false;
    use HasFactory;

    public function immunization_category(){
        return $this->belongsTo(ImmunizationCategory::class);
    }

    protected $fillable = ['immunization_id','immunization_category_id','first_name','middle_name','last_name','date_of_birth','gender','place_of_birth','age','barangay','municipality','province','contact_no','father_full_name','mother_full_name','height','weight','vaccine_received','doses','doses_received','first_dose_schedule','first_dose_vaccinated_at','second_dose_schedule','second_dose_vaccinated_at','third_dose_schedule','third_dose_vaccinated_at','remarks','date_recorded',]; 
}
