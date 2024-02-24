<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
         $image =  request()->isMethod('put') ?
             'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000' :
             'required|mimes:png,jpg,jpeg,webp,svg,gif|max:1000';

        return [
            'category_id' =>'required',
            'language_id' =>'nullable',
            'new' =>'nullable',
            'featured' =>'nullable',
            'offer' =>'nullable',
            'image' =>$image,
            'name' =>'required|max:255',
            'price' =>'required',
            'currency' =>'required|max:255',
            'weight' =>'nullable|max:255',
            'size' =>'nullable|max:255',
            'description' =>'required|max:255',
            'benefits' =>'nullable|max:255',
            'quantity' =>'required|integer',
            'calories' =>'nullable|integer',
            'carbohydrates' =>'nullable|integer',
            'fiber' =>'nullable|integer',
            'cholesterol' =>'nullable|integer',
            'sugar' =>'nullable|integer',
            'fats' =>'nullable|integer',
            'translate_id' =>'nullable',
            'status' => 'nullable|integer',
            'sort' => 'nullable|integer|min:0',
        ];

    }

    public function messages()
    {
        return [
            'category_id.required' =>__('text.categoryRequired'),
            'type.in' =>__('text.typeInValidation'),
            'image.required' =>__('text.imageRequired'),
            'image.mimes' =>__('text.imageMimes'),
            'image.max' =>__('text.imageMax'),
            'name.required' =>__('text.nameRequired'),
            'name.max' =>__('text.nameMax'),
            'price.required' =>__('text.priceRequired'),
            'currency.required' =>__('text.currencyRequired'),
            'description.required' =>__('text.descriptionRequired'),
            'quantity.required' =>__('text.quantityRequired'),
            'status.integer' =>__('text.statusInteger'),
            'sort.integer' =>__('text.sortInteger'),
            'sort.min' =>__('text.sortMin'),

        ];
    }



}
