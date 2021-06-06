<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OutboundStoreRequest extends FormRequest
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
            'keydate_id' => ['required', 'exists:keydates,id'],
            'recipient' => ['required', 'max:255', 'string'],
            'trust' => ['required', 'max:255', 'string'],
            'trust_logo' => ['required', 'max:255', 'string'],
            'message' => ['required', 'max:2550', 'string'],
            'message_data' => ['max:2550', 'string'],
        ];
    }
}
