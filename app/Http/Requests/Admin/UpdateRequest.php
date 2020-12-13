<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'username'  => 'bail|nullable',
            'full_name' => 'bail|nullable|regex:/^[a-zA-Z\s]{1,199}$/'
        ];
    }

    public function messages() {
        return [
            'full_name.regex'   => 'Full name is invalid'
        ];
    }
}
