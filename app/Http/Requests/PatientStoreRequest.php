<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'dob' => ['required', 'date', 'date'],
            'nhsnum' => ['required', 'max:255', 'string'],
            'phone' => ['max:255', 'string'],
            'email' => ['required', 'email'],
            'notes' => ['max:255', 'string'],
        ];
    }
}
