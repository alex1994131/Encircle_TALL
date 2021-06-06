<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientCampaignStoreRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'condition' => ['required', 'max:255', 'string'],
            'subcondition' => ['required', 'max:255', 'string'],
            'campaign_id' => ['required', 'exists:campaigns,id'],
            'content' => ['required', 'max:255', 'string'],
        ];
    }
}
