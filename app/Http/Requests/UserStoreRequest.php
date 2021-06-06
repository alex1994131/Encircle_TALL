<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required'],
            'department' => ['nullable', 'max:255', 'string'],
            'jobtitle' => ['nullable', 'max:255', 'string'],
            'roles' => 'array',
        ];
    }
}
