<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUpdateAddressRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'fname' =>'required|max:255',
            'lname' =>'required|max:255',
            'address' =>'required|max:255',
            'city' =>'nullable|max:255',
        ];
    }


    public function messages()
    {
        return [
            'fname.required' =>__("text.nameRequired"),
            'fname.max' => __("text.nameMax"),
            'lname.required' =>__("text.nameRequired"),
            'lname.max' => __("text.nameMax"),
            'address.required' =>__("text.addressRequired"),
            'address.max' => __("text.addressMax"),
        ];
    }

}
