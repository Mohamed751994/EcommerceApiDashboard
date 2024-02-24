<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
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
        return [
            'type' => 'nullable',
            'name' => 'required|max:255',
            'email' => $email,
            'password' => 'nullable|min:8|max:25',
            'roles' => 'required',
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
            'roles.required' =>__('text.rolesRequired'),

        ];
    }



}
