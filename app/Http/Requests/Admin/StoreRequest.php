<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'username'  => 'bail|required|regex:/^[\w]{1,199}$/',
            'full_name' => 'bail|nullable|regex:/^[a-zA-Z\s]{1,199}$/'
        ];
    }

    public function messages() {
        return [
            'username.required' => 'Please enter username',
            'username.regex'    => 'Username is invalid',
            'full_name.regex'   => 'Full name is invalid'
        ];
    }
}
