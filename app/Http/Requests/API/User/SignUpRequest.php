<?php

namespace App\Http\Requests\API\User;

use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
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
            'username'  => 'bail|required|unique:users,username|regex:/^[\w]{1,199}$/',
            'password'  => 'bail|required|min:6|max:20',
            'full_name' => 'bail|nullable|regex:/^[a-zA-Z\s]{1,199}$/',
            'email'     => 'bail|nullable|email',
            'phone'     => 'bail|nullable|regex:/^0[35789]\d{8}$/',
            'avatar'    => 'bail|nullable|image|mimes:png,jpg,jpeg'
        ];
    }

    public function messages() {
        return [
            'username.required' => 'Please enter username',
            'username.regex'    => 'Username is invalid',
            'username.unique'   => 'Username is already exist',
            'password.required' => 'Please enter password',
            'password.min'      => 'Password minimum is 6 character',
            'password.max'      => 'Password maximum is 20 character',
            'full_name.regex'   => 'Full name is invalid',
            'email.email'       => 'Email must be email format',
            'phone.regex'       => 'Phone is invalid',
            'avatar.image'      => 'Avatar must be image format',
            'avatar.mimes'      => 'Format avatar is invalid'
        ];
    }
}
