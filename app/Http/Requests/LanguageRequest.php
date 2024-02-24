<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguageRequest extends FormRequest
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
        $code =  request()->isMethod('put') ?
            'required|max:3|unique:languages,code,'.\Request::segment(3).',id' :
            'required|unique:languages,code|max:3';
        return [
            'name' => 'required|max:255',
            'code' => $code,
            'currency' => 'required|max:255',
            'icon' =>'nullable|mimes:png,jpg,jpeg,webp,svg|max:1000',
            'status' => 'nullable|integer',
            'sort' => 'nullable|integer|min:0',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'code.required' =>__('text.codeRequired'),
            'code.max' =>__('text.codeMax'),
            'code.unique' =>__('text.codeUnique'),
            'currency.required' =>__('text.currencyRequired'),
            'currency.max' =>__('text.currencyMax'),
            'icon.mimes' =>__('text.mimesImage'),
            'icon.max' =>__('text.maxImage'),
            'status.integer' =>__('text.statusInteger'),
            'sort.integer' =>__('text.sortInteger'),
            'sort.min' =>__('text.sortMin'),

        ];
    }



}
