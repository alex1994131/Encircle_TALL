<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignUpdateRequest extends FormRequest
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
            'trust_id' => ['nullable', 'exists:trusts,id'],
            'content' => ['required', 'max:512', 'string'],
            'msgs' => ['nullable', 'max:512', 'string'],
            'msg_title.*' => ['required', 'max:512', 'string'],
            'msg_text.*' => ['required', 'max:512', 'string'],
            // 'access_type' => [
            //     'nullable',php 
            //     'in:global,local',
            // ],
            'category' => [
                'nullable',
                'in:advice,appointment,result',
            ],
            'title' => ['required', 'max:255', 'string'],
            'condition_id' => ['required', 'max:255'],
            'subCondition_id' => ['required', 'max:255'],
            'published' => ['boolean'],
        ];
    }
}
