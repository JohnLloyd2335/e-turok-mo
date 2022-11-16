<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVaccineRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */

    public function messages(){
        return [
            'vaccine_category_id.required' => 'The vaccine category field is required',
            'vaccine_name.unique' => 'Vaccine already exists'
        ];
    }

    public function rules()
    {
        return [
                'vaccine_category_id' => 'required',
                'vaccine_name' => ['required','min:5','max:100','unique:vaccines'],
                'doses' => ['required','numeric','min:1','max:3'],
                'second_dose_years_interval' => 'required_if:doses,2|required_if:doses,3',
                'second_dose_months_interval' => 'required_if:doses,2|required_if:doses,3',
                'second_dose_days_interval' => 'required_if:doses,2|required_if:doses,3',
                'third_dose_years_interval' => 'required_if:doses,3',
                'third_dose_months_interval' => 'required_if:doses,3',
                'third_dose_days_interval' => 'required_if:doses,3',
                'description' => 'required',

        ];
    }
}
