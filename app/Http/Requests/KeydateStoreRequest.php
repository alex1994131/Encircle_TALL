<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeydateStoreRequest extends FormRequest
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
            'type' => ['required', 'max:255', 'string'],
            'test_order' => ['required', 'max:255', 'string'],
            'next_test_order' => ['required', 'max:255', 'string'],
            'lab_ref' => ['required', 'max:255', 'string'],
            'next_appointment' => ['required', 'max:255', 'string'],
            'apt_date' => ['required', 'date', 'date'],
            'campaign_num' => ['required', 'numeric'],
            'test_type_id' => ['required', 'exists:test_types,id'],
            'result' => ['required', 'max:255', 'string'],
            'patient_id' => ['required', 'max:255'],
        ];
    }
}
