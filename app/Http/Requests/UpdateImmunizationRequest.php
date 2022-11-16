<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateImmunizationRequest extends FormRequest
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
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'place_of_birth' => 'required',
            'contact_no' => 'required|numeric|digits:11',
            'father_full_name' => 'required',
            'mother_full_name' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'vaccine_received' => 'required',
            'doses_received' => 'required',
            'remarks' => 'required',
        ];
    }
}
