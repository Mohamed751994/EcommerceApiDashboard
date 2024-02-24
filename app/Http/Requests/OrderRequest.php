<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'user_id' => 'nullable',
            'orderID' => 'nullable',
            'language' => 'nullable',
            'user_name' => 'required|max:255',
            'user_email' => 'required|max:255',
            'user_phone' => 'required|min:8|max:20',
            'user_address' => 'required|max:255',
            'user_city' => 'required|max:255',
            'company_name' => 'nullable',
            'notes' => 'nullable',
            'products.*' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'user_name.required' =>__('text.nameRequired'),
            'user_name.max' =>__('text.nameMax'),
            'user_email.required' =>__('text.emailRequired'),
            'user_email.max' =>__('text.emailMax'),
            'user_phone.required' =>__('text.phoneRequired'),
            'user_phone.min' =>__('text.phoneMin'),
            'user_phone.max' =>__('text.phoneMax'),
            'user_address.required' =>__('text.addressRequired'),
            'user_address.max' =>__('text.nameMax'),
            'user_city.required' =>__('text.cityRequired'),
            'user_city.max' =>__('text.nameMax'),
        ];
    }



}
