<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVaccineRequest extends FormRequest
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
            'vaccine_category_id.required' => 'The vaccine category field is required',
            
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
            'vaccine_category_id' => 'required',
            'vaccine_name' => ['required','min:5','max:30','unique:vaccines,vaccine_name,'.$this->vaccine->id],
            'doses' => ['required','numeric','min:1','max:3'],
            'status' => 'required',
            'description' => 'required',
        ];
    }
}
