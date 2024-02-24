<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
            'phone' => 'required|min:8|max:20',
            'gender' => 'nullable',
            'date_birth' => 'nullable',
            'image' =>   'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'phone.required' =>__('text.phoneRequired'),
            'phone.min' =>__('text.phoneMin'),
            'phone.max' =>__('text.phoneMax'),
            'image.mimes' =>__('text.imageMimes'),
            'image.max' =>__('text.imageMax'),
        ];
    }



}
