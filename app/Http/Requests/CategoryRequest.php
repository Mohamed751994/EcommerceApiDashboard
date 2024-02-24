<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' =>'required|max:255',
            'translate_id' =>'nullable',
            'status' => 'nullable|integer',
            'sort' => 'nullable|integer|min:0',
        ];

    }

    public function messages()
    {
        return [
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'status.integer' =>__('text.statusInteger'),
            'sort.integer' =>__('text.sortInteger'),
            'sort.min' =>__('text.sortMin'),

        ];
    }



}
