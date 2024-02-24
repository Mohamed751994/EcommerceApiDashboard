<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainRequest extends FormRequest
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
            'slug' => 'nullable|max:255',
            'category_id' => 'nullable',
            'title_en' => 'nullable|max:255',
            'title_ar' => 'nullable|max:255',
            'name_en' => 'nullable|max:255',
            'name_ar' => 'nullable|max:255',
            'job_title_en' => 'nullable|max:255',
            'job_title_ar' => 'nullable|max:255',
            'short_description_en' => 'nullable',
            'short_description_ar' => 'nullable',
            'description_en' => 'nullable',
            'description_ar' => 'nullable',
            'image' =>'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000' ,
            'icon' =>'nullable|mimes:png,jpg,jpeg,webp,svg,gif|max:1000' ,
            'brochure' =>'nullable|mimes:pdf,doc,docx|max:10000' ,
            'home_display' => 'nullable|integer',
            'status' => 'nullable|integer',
            'sort' => 'nullable|integer|min:0',
            'tags' => 'nullable',
            'views' => 'nullable',
            'requirements_en' => 'nullable',
            'requirements_ar' => 'nullable',
            'job_time' => 'nullable',
            'job_type' => 'nullable',
            'label' => 'nullable',
            'key' => 'nullable',
            'value' => 'nullable',
            'input_type' => 'nullable',
            'name' => 'nullable',
            'email' => 'nullable|email',
            'password' => 'nullable|min:8|max:25',
            'roles' => 'nullable',
        ];

    }

    public function messages()
    {
        return [
            'image.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'image.max' =>'يجب أن لا تتعدي حجم الصورة 1 ميجا بايت',
            'icon.mimes' =>'يجب أن تكون صيغة الصورة (png - jpg - jpeg - webp - svg - gif) ',
            'icon.max' =>'يجب أن لا تتعدي حجم الصورة 1 ميجا بايت',
            'brochure.mimes' =>'يجب أن تكون صيغة الملف (pdf - doc - docx) ',
            'brochure.max' =>'يجب أن لا يتعدي حجم الملف 10 ميجا بايت',
        ];
    }



}
