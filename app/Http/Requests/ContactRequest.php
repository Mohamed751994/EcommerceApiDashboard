<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' => 'required|min:8|max:20',
            'message' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'email.required' =>__('text.emailRequired'),
            'email.max' =>__('text.emailMax'),
            'phone.required' =>__('text.phoneRequired'),
            'phone.min' =>__('text.phoneMin'),
            'phone.max' =>__('text.phoneMax'),
        ];
    }



}
