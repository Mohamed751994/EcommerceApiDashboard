<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $email =  request()->isMethod('put') ?
            'required|email|max:255|unique:users,email,'.\Request::segment(3).',id' :
            'required|unique:users,email|email|max:255';
        if (request()->is('api/*')) {
            $password = 'required|min:8|max:25|confirmed';
        }
        else
        {
            $password =  'nullable|min:8|max:25|confirmed';
        }
        return [
            'type' => 'nullable',
            'name' => 'required|max:255',
            'phone' => 'required|min:8|max:20',
            'email' => $email,
            'password' => $password,
            'gender' => 'nullable',
            'date_birth' => 'nullable',
            'image' => 'nullable',
            'active' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'email.required' =>__('text.emailRequired'),
            'email.max' =>__('text.emailMax'),
            'email.email' =>__('text.emailValid'),
            'email.unique' =>__('text.emailUnique'),
            'password.required' =>__('text.passwordRequired'),
            'password.min' =>__('text.passwordMin'),
            'password.max' =>__('text.passwordMax'),
            'password.confirmed' =>__('text.confirmPassword'),
            'phone.required' =>__('text.phoneRequired'),
            'phone.min' =>__('text.phoneMin'),
            'phone.max' =>__('text.phoneMax'),
        ];
    }



}
