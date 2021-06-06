<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LibraryStoreRequest extends FormRequest
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
            'msg_title' => ['required', 'max:512', 'string'],
            'msg_text' => ['required', 'max:512', 'string'],
            'add_url' => ['required', 'max:512', 'string'],
            'telephone' => ['required', 'max:512', 'string'],
            'selected_date' => ['required', 'max:512', 'string'],
        ];
    }
}
