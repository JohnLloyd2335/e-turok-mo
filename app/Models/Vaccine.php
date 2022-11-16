<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\VaccineCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vaccine extends Model
{
    use HasFactory;

    public function vaccine_category(){
        return $this->belongsTo(VaccineCategory::class);
    }

    protected $fillable = ['vaccine_category_id','vaccine_name','doses','second_dose_years_interval','second_dose_months_interval','second_dose_days_interval','third_dose_years_interval','third_dose_months_interval','third_dose_days_interval','status','description','date_created'];

    
}
