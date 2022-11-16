<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImmunizationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function messages(){
        return [
           'vaccine_received.required' => 'The vaccine field is required.',
           'first_dose_vaccinated_at.required' => 'vaccinated at field is required',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'immunization_category_id' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'barangay' => 'required',
            'contact_no' => 'required|numeric|digits:11',
            'father_full_name' => 'required',
            'mother_full_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vaccine_received' => 'required',
            'doses_received' => 'required',
            'first_dose_vaccinated_at' => 'required',
            'remarks' => 'required',
        ];
    }
}
