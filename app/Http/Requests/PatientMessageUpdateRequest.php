<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientMessageUpdateRequest extends FormRequest
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
            'patient_id' => ['required', 'exists:patients,id'],
            'patient_campaign_id' => [
                'required',
                'exists:patient_campaigns,id',
            ],
            'library_id' => ['required', 'exists:libraries,id'],
            'content' => ['required', 'max:255', 'string'],
            'data' => ['required', 'max:255', 'string'],
        ];
    }
}
